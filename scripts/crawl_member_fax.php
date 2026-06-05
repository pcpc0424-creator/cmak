<?php
/**
 * cmak.or.kr 의 회원사 페이지에서 FAX(및 기타 누락된 정보)를 가져와 DB에 매칭하여 채우는 일회성 스크립트
 *
 * 실행: php /var/www/cmak/scripts/crawl_member_fax.php
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$BASE_URL = 'https://www.cmak.or.kr/html/intro/imember.asp';
$TOTAL_PAGES = 18;

function fetchPage(string $url): string {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        CURLOPT_HTTPHEADER => [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Accept-Language: ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7',
            'Accept-Encoding: identity',
        ],
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CONNECTTIMEOUT => 10,
    ]);
    $body = curl_exec($ch);
    curl_close($ch);
    if ($body === false) return '';
    return mb_convert_encoding($body, 'UTF-8', 'EUC-KR');
}

/**
 * 회사명을 정규화 - 매칭 키 생성
 * (주), ㈜, 공백, 영문 대소문자 무시
 */
function normalizeName(string $name): string {
    $name = preg_replace('/[\(（]주[\)）]|㈜|주식회사|\(社\)/u', '', $name);
    $name = preg_replace('/[\s\.\-_]+/u', '', $name);
    $name = mb_strtolower(trim($name), 'UTF-8');
    return $name;
}

/**
 * 한 페이지의 HTML에서 회원사 행 추출
 * 각 회원사는 width="636" 테이블 안의 한 행
 */
function parseMembers(string $html): array {
    $members = [];
    // 회원 데이터가 든 테이블 추출 (width="636" cellpadding="0" height="45")
    if (!preg_match_all(
        '/<table\s+width="636"[^>]*height="45"[^>]*>(.*?)<\/table>/is',
        $html,
        $tables
    )) {
        return $members;
    }

    foreach ($tables[1] as $tableHtml) {
        // 각 td 추출
        if (!preg_match_all('/<td[^>]*>(.*?)<\/td>/is', $tableHtml, $tds)) continue;
        $cells = array_map(function($v){
            $v = preg_replace('/<[^>]+>/', '', $v);
            $v = html_entity_decode($v, ENT_QUOTES, 'UTF-8');
            return trim(preg_replace('/\s+/u', ' ', $v));
        }, $tds[1]);

        // 빈 셀(구분선) 필터링하지 않고 인덱스 기반으로 처리:
        // 0: 번호, 1:공백, 2: 업종, 3:공백, 4: 회사명, 5:공백, 6: 대표자, 7:공백, 8: 전화, 9:공백, 10: FAX, 11:공백, 12: 주소
        if (count($cells) < 13) continue;
        $no = $cells[0];
        $type = $cells[2];
        $company = $cells[4];
        $rep = $cells[6];
        $phone = $cells[8];
        $fax = $cells[10];
        $address = $cells[12];

        if ($company === '' || !is_numeric($no)) continue;

        $members[] = compact('no', 'type', 'company', 'rep', 'phone', 'fax', 'address');
    }
    return $members;
}

// === 1단계: 모든 페이지 크롤링 ===
echo "[1/2] 원본 사이트에서 회원사 데이터 크롤링 중...\n";
$allMembers = [];
for ($page = 1; $page <= $TOTAL_PAGES; $page++) {
    $url = $BASE_URL . "?GotoPage={$page}&searchdiv=";
    $html = fetchPage($url);
    if ($html === '') {
        echo "  - {$page}페이지 가져오기 실패\n";
        continue;
    }
    $members = parseMembers($html);
    $allMembers = array_merge($allMembers, $members);
    echo "  - {$page}페이지: " . count($members) . "건\n";
    usleep(300_000); // 0.3초 대기 (서버 부담 방지)
}
echo "총 " . count($allMembers) . "건 수집\n\n";

// === 2단계: DB 매칭 및 업데이트 ===
echo "[2/2] DB 회원사와 매칭하여 FAX(및 누락 데이터) 업데이트 중...\n";

// DB 회원사 정규화된 이름으로 인덱싱
$dbMembers = DB::table('member_companies')->get(['id', 'company_name']);
$dbIndex = [];
foreach ($dbMembers as $m) {
    $key = normalizeName($m->company_name);
    if ($key !== '') {
        $dbIndex[$key][] = $m->id;
    }
}

$updated = 0;
$matched = 0;
$unmatchedSamples = [];

foreach ($allMembers as $m) {
    $key = normalizeName($m['company']);
    if (!isset($dbIndex[$key])) {
        if (count($unmatchedSamples) < 10) $unmatchedSamples[] = $m['company'];
        continue;
    }
    $matched++;
    $ids = $dbIndex[$key];

    $updateData = [];
    if ($m['fax'] !== '' && $m['fax'] !== '-') $updateData['fax'] = $m['fax'];
    if ($m['type'] !== '' && in_array($m['type'], ['용역','시공','설계','감리','엔지니어링','CM','기타'])) {
        $updateData['company_type'] = $m['type'];
    }

    if (!empty($updateData)) {
        $affected = DB::table('member_companies')->whereIn('id', $ids)->update($updateData);
        $updated += $affected;
    }
}

echo "  - 매칭된 회원사: {$matched}건\n";
echo "  - 업데이트된 행: {$updated}건\n";
if (!empty($unmatchedSamples)) {
    echo "  - 매칭 실패 샘플:\n";
    foreach ($unmatchedSamples as $s) echo "    · {$s}\n";
}

echo "\n=== 결과 확인 ===\n";
echo "FAX 채워진 회원사: " . DB::table('member_companies')->whereNotNull('fax')->where('fax','!=','')->count() . " / " . DB::table('member_companies')->count() . "\n";
echo "업종 통계:\n";
foreach (DB::table('member_companies')->select('company_type', DB::raw('count(*) as c'))->groupBy('company_type')->orderByDesc('c')->get() as $r) {
    echo "  · " . ($r->company_type ?: '(없음)') . ": {$r->c}\n";
}
