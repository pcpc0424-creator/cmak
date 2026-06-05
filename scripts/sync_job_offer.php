<?php
/**
 * 구인(job_offer) 게시판 메타데이터(지역/회사명/마감일 등) + 본문(모집내용) 동기화
 * 원본: http://www.cmak.or.kr/html/free/wanted.asp (목록) / wanted_r.asp?no= (상세)
 * 사용법: php scripts/sync_job_offer.php [--dry-run]
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Post;

$baseUrl = 'http://www.cmak.or.kr';
$dryRun = in_array('--dry-run', $argv);

function fetchRaw(string $url, int $retries = 3): string
{
    for ($attempt = 1; $attempt <= $retries; $attempt++) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            CURLOPT_HTTPHEADER => [
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7',
                'Referer: http://www.cmak.or.kr/',
                'Cache-Control: no-cache',
            ],
        ]);
        $html = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // 차단 페이지(1~2KB 에러문서) 방어
        if ($code === 200 && $html && strlen($html) > 5000) {
            return $html;
        }
        if ($attempt < $retries) sleep(2 * $attempt);
    }
    return '';
}

function toUtf8(string $raw): string
{
    return @mb_convert_encoding($raw, 'UTF-8', 'EUC-KR') ?: $raw;
}

function cleanText(string $html): string
{
    $t = html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8');
    $t = str_replace("\u{a0}", ' ', $t); // &nbsp;
    return trim(preg_replace('/\s+/u', ' ', $t));
}

function normalizeTitle(string $t): string
{
    $t = html_entity_decode($t, ENT_QUOTES, 'UTF-8');
    $t = str_replace("\u{a0}", ' ', $t);
    $t = preg_replace('/\s+/u', '', $t);
    return mb_strtolower(trim($t));
}

// 상세 페이지에서 라벨 다음 값 td 추출 (라벨은 중첩 table 안에 있음)
function extractField(string $html, string $label): string
{
    $pattern = '/' . $label . '<\/td>\s*<\/tr>\s*<\/table>\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/s';
    if (preg_match($pattern, $html, $m)) {
        return cleanText($m[1]);
    }
    return '';
}

// 1. 목록 페이지에서 no/지역/회사명/마감일 수집
$rows = [];
for ($page = 1; $page <= 20; $page++) {
    $raw = fetchRaw($baseUrl . '/html/free/wanted.asp?GotoPage=' . $page);
    if (!$raw) {
        echo "[오류] 목록 {$page}페이지 요청 실패\n";
        exit(1);
    }
    $html = toUtf8($raw);
    $parts = preg_split('/<table[^>]*height="45">/', $html);
    array_shift($parts);

    $newCount = 0;
    foreach ($parts as $part) {
        if (!preg_match('/go_Edit\(\'(\d+)\'\)/', $part, $no)) continue;
        if (isset($rows[$no[1]])) continue;
        preg_match_all('/<td[^>]*width="(31|61|200|150|58)"[^>]*>(.*?)<\/td>/s', $part, $tds, PREG_SET_ORDER);
        $row = ['no' => $no[1], 'area' => '', 'title' => '', 'company' => '', 'reg' => '', 'deadline' => ''];
        $w61 = [];
        foreach ($tds as $td) {
            $v = cleanText($td[2]);
            if ($td[1] === '200') $row['title'] = $v;
            elseif ($td[1] === '150') $row['company'] = $v;
            elseif ($td[1] === '61') $w61[] = $v;
        }
        $row['area'] = $w61[0] ?? '';
        $row['reg'] = $w61[1] ?? '';
        $row['deadline'] = $w61[2] ?? '';
        $rows[$no[1]] = $row;
        $newCount++;
    }
    echo "목록 {$page}페이지: 신규 {$newCount}건\n";
    if ($newCount === 0) break;
    usleep(800000);
}
echo "원본 총 " . count($rows) . "건 수집\n\n";

// 2. 로컬 게시글 인덱스 (등록일+정규화제목)
$posts = Post::where('board_type', 'job_offer')->get();
$localIndex = [];
foreach ($posts as $p) {
    $key = ($p->published_at ? $p->published_at->format('y.m.d') : '') . '|' . normalizeTitle($p->title ?? '');
    $localIndex[$key][] = $p;
}

// 3. 상세 페이지 크롤링 후 매칭/갱신
$updated = $unmatched = $failed = 0;
foreach ($rows as $row) {
    $raw = fetchRaw($baseUrl . '/html/free/wanted_r.asp?no=' . $row['no']);
    if (!$raw) {
        echo "[오류] 상세 no={$row['no']} 요청 실패\n";
        $failed++;
        continue;
    }
    $html = toUtf8($raw);

    // 제목 행: <td colspan="4" class=free>회사명 :&nbsp; 제목</td>
    $detailCompany = '';
    $detailTitle = '';
    if (preg_match('/<td colspan="4" class=free>(.*?)<\/td>/s', $html, $m)) {
        $line = html_entity_decode($m[1], ENT_QUOTES, 'UTF-8');
        $line = str_replace("\u{a0}", ' ', $line);
        if (preg_match('/^(.*?)\s*:\s*(.*)$/s', $line, $tm)) {
            $detailCompany = trim(preg_replace('/\s+/u', ' ', $tm[1]));
            $detailTitle = trim(preg_replace('/\s+/u', ' ', $tm[2]));
        }
    }

    // 등록일
    $reg = '';
    if (preg_match('/등록일\s*:\s*(\d{4})\.(\d{2})\.(\d{2})/s', $html, $m)) {
        $reg = substr($m[1], 2) . '.' . $m[2] . '.' . $m[3];
    }

    // 모집내용 본문 (HTML 유지)
    $content = '';
    if (preg_match('/모집내용<\/td>\s*<\/tr>\s*<\/table>\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/s', $html, $m)) {
        $content = $m[1];
        $content = preg_replace('/<img[^>]*space\.gif[^>]*>/i', '', $content);
        $content = trim($content);
        $content = preg_replace('/^(<br\s*\/?>\s*)+|(\s*<br\s*\/?>)+$/i', '', $content);
        $content = trim($content);
    }

    $meta = array_filter([
        'company' => $detailCompany ?: $row['company'],
        'company_address' => extractField($html, '회사주소'),
        'contact' => extractField($html, '연&nbsp;락&nbsp;처'),
        'manager' => extractField($html, '담당자'),
        'region' => extractField($html, '근무지역') ?: $row['area'],
        'employment_type' => extractField($html, '고용형태'),
        'career' => extractField($html, '경력구분'),
        'education' => extractField($html, '최종학력'),
        'salary' => extractField($html, '급여조건'),
        'deadline' => extractField($html, '마&nbsp;감&nbsp;일') ?: $row['deadline'],
    ], fn($v) => $v !== '' && $v !== 'Tel. -- Fax.');

    // 연락처 빈값 정리 (Tel. -- Fax. 형태)
    if (isset($meta['contact'])) {
        $meta['contact'] = trim(preg_replace('/Tel\.\s*--?\s*/', '', $meta['contact']));
        $meta['contact'] = trim(preg_replace('/Fax\.\s*$/', '', $meta['contact']));
        if ($meta['contact'] === '' || $meta['contact'] === 'Tel.') unset($meta['contact']);
    }

    // 로컬 매칭: 등록일 + 제목
    $key = $reg . '|' . normalizeTitle($detailTitle);
    $candidates = $localIndex[$key] ?? [];
    if (count($candidates) !== 1) {
        echo "[미매칭] no={$row['no']} ({$reg}) '" . mb_substr($detailTitle, 0, 30) . "' → 후보 " . count($candidates) . "건\n";
        $unmatched++;
        continue;
    }

    $post = $candidates[0];
    echo "[갱신] #{$post->id} no={$row['no']} ({$reg}) " . mb_substr($post->title ?: '(제목없음)', 0, 30) . "\n";
    echo "       region='" . ($meta['region'] ?? '') . "' company='" . ($meta['company'] ?? '') . "' deadline='" . ($meta['deadline'] ?? '') . "' content_len=" . mb_strlen($content) . "\n";

    if (!$dryRun) {
        $post->metadata = array_merge($post->metadata ?? [], $meta);
        if ($content !== '' && trim($post->content ?? '') === '') {
            $post->content = $content;
        }
        $post->saveQuietly();
    }
    $updated++;
    usleep(800000);
}

echo "\n완료: 갱신 {$updated}건, 미매칭 {$unmatched}건, 요청실패 {$failed}건" . ($dryRun ? ' (dry-run)' : '') . "\n";
