<?php
/**
 * cmak.or.kr 의 회원사 데이터를 100% 일치하게 동기화
 * - 기존 636개는 모두 is_active=false로 비활성화 (보존)
 * - 원본 179개를 신규 INSERT (FAX/주소/업종/전화 등 모든 필드 채움)
 *
 * 실행: php /var/www/cmak/scripts/replace_members_with_original.php
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
            'Accept-Language: ko-KR,ko;q=0.9',
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
 * 주소에서 시/도 추출
 */
function extractRegion(string $address): string {
    static $mapping = [
        '서울'=>'서울','부산'=>'부산','대구'=>'대구','인천'=>'인천','광주'=>'광주',
        '대전'=>'대전','울산'=>'울산','세종'=>'세종','경기'=>'경기','강원'=>'강원',
        '충북'=>'충북','충남'=>'충남','전북'=>'전북','전남'=>'전남','경북'=>'경북',
        '경남'=>'경남','제주'=>'제주',
        '서울특별시'=>'서울','부산광역시'=>'부산','대구광역시'=>'대구','인천광역시'=>'인천',
        '광주광역시'=>'광주','대전광역시'=>'대전','울산광역시'=>'울산','세종특별자치시'=>'세종',
        '경기도'=>'경기','강원도'=>'강원','강원특별자치도'=>'강원','충청북도'=>'충북',
        '충청남도'=>'충남','전라북도'=>'전북','전북특별자치도'=>'전북','전라남도'=>'전남',
        '경상북도'=>'경북','경상남도'=>'경남','제주특별자치도'=>'제주','제주도'=>'제주',
    ];
    // 우편번호 (37830) 패턴 제거
    $clean = preg_replace('/^\(\d+\)\s*/', '', trim($address));
    $first = preg_split('/\s+/', $clean)[0] ?? '';
    return $mapping[$first] ?? '';
}

function parseMembers(string $html): array {
    $members = [];
    if (!preg_match_all('/<table\s+width="636"[^>]*height="45"[^>]*>(.*?)<\/table>/is', $html, $tables)) {
        return $members;
    }
    foreach ($tables[1] as $tableHtml) {
        // 회사명 a태그의 href(웹사이트)도 추출
        $website = '';
        if (preg_match('/<a\s+href="([^"]+)"[^>]*target=/i', $tableHtml, $am)) {
            $website = $am[1];
        }
        if (!preg_match_all('/<td[^>]*>(.*?)<\/td>/is', $tableHtml, $tds)) continue;
        $cells = array_map(function($v){
            $v = preg_replace('/<[^>]+>/', '', $v);
            $v = html_entity_decode($v, ENT_QUOTES, 'UTF-8');
            return trim(preg_replace('/\s+/u', ' ', $v));
        }, $tds[1]);
        if (count($cells) < 13) continue;
        $no = $cells[0];
        if ($company = $cells[4] ?? '') {} else continue;
        if (!is_numeric($no)) continue;
        $type = $cells[2];
        $rep = $cells[6];
        $phone = $cells[8];
        $fax = $cells[10];
        $address = $cells[12];

        $members[] = [
            'no' => (int)$no,
            'company_type' => in_array($type, ['용역','시공','설계','감리','엔지니어링','CM','기타']) ? $type : null,
            'company_name' => $company,
            'representative' => $rep ?: null,
            'phone' => $phone ?: null,
            'fax' => $fax ?: null,
            'address' => $address ?: null,
            'website' => $website ?: null,
            'region' => extractRegion($address),
        ];
    }
    return $members;
}

// === 1단계: 크롤링 ===
echo "[1/3] 원본 사이트 크롤링 중...\n";
$allMembers = [];
for ($page = 1; $page <= $TOTAL_PAGES; $page++) {
    $url = $BASE_URL . "?GotoPage={$page}&searchdiv=";
    $html = fetchPage($url);
    if ($html === '') { echo "  - {$page}페이지 실패\n"; continue; }
    $members = parseMembers($html);
    $allMembers = array_merge($allMembers, $members);
    echo "  - {$page}페이지: " . count($members) . "건\n";
    usleep(300_000);
}
echo "총 " . count($allMembers) . "건 수집\n\n";

// === 2단계: 기존 636개 비활성화 ===
echo "[2/3] 기존 회원사 비활성화 (보존) 중...\n";
$beforeActive = DB::table('member_companies')->where('is_active', 1)->count();
$deactivated = DB::table('member_companies')->where('is_active', 1)->update(['is_active' => 0]);
echo "  - 기존 활성 {$beforeActive}건 → 비활성화 {$deactivated}건\n\n";

// === 3단계: 원본 179개 신규 INSERT ===
echo "[3/3] 원본 회원사 신규 등록 중...\n";
$now = date('Y-m-d H:i:s');
$inserted = 0;
foreach ($allMembers as $m) {
    DB::table('member_companies')->insert([
        'company_name'   => $m['company_name'],
        'region'         => $m['region'] ?: null,
        'company_type'   => $m['company_type'],
        'representative' => $m['representative'],
        'phone'          => $m['phone'],
        'fax'            => $m['fax'],
        'address'        => $m['address'],
        'website'        => $m['website'],
        'is_active'      => 1,
        'is_verified'    => 1,
        'is_integrated'  => 0,
        'sort_order'     => $m['no'],
        'created_at'     => $now,
        'updated_at'     => $now,
    ]);
    $inserted++;
}
echo "  - 신규 등록: {$inserted}건\n\n";

// === 결과 확인 ===
echo "=== 결과 ===\n";
echo "활성 회원사: " . DB::table('member_companies')->where('is_active',1)->count() . "건\n";
echo "비활성 회원사: " . DB::table('member_companies')->where('is_active',0)->count() . "건\n";
echo "FAX 채워진 활성 회원사: " . DB::table('member_companies')->where('is_active',1)->whereNotNull('fax')->where('fax','!=','')->count() . "건\n";
echo "\n지역 분포:\n";
foreach (DB::table('member_companies')->where('is_active',1)->select('region', DB::raw('count(*) as c'))->whereNotNull('region')->where('region','!=','')->groupBy('region')->orderByDesc('c')->get() as $r) {
    echo "  · {$r->region}: {$r->c}\n";
}
echo "\n업종 분포:\n";
foreach (DB::table('member_companies')->where('is_active',1)->select('company_type', DB::raw('count(*) as c'))->groupBy('company_type')->orderByDesc('c')->get() as $r) {
    echo "  · " . ($r->company_type ?: '(없음)') . ": {$r->c}\n";
}
