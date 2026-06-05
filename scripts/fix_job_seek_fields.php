#!/usr/bin/env php
<?php
/**
 * 구직(job_seek) 게시판 데이터 복구
 * - 목록: 이름/연령/지역/희망직종 → author + metadata
 * - 상세: 본문(자기소개/경력) → content
 *   (과거 크롤러가 첫 번째 class=low 셀(공백)만 가져가 본문이 누락됐음)
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

$baseUrl = 'http://www.cmak.or.kr';
$dryRun = in_array('--dry-run', $argv);

function fetchRaw(string $url, int $retries = 4): string
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
                'Referer: http://www.cmak.or.kr/html/free/hunting.asp',
                'Cache-Control: no-cache',
            ],
        ]);
        $html = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($code === 200 && $html) return $html;
        if ($attempt < $retries) sleep(2 * $attempt);
    }
    return '';
}

function toUtf8(string $raw): string
{
    return @mb_convert_encoding($raw, 'UTF-8', 'EUC-KR') ?: $raw;
}

function cleanText(string $s): string
{
    return trim(html_entity_decode(strip_tags($s), ENT_QUOTES, 'UTF-8'), " \t\n\r\0\x0B\xC2\xA0");
}

// 1단계: 목록 페이지에서 행 단위 필드 추출
// 행 구조: 번호 | 등록일 | 이름(mailto) | 제목(go_Edit) | 연령 | 지역 | 희망직종
echo "[1] 목록 수집\n";
$rows = [];
for ($page = 1; $page <= 5; $page++) {
    $raw = toUtf8(fetchRaw($baseUrl . '/html/free/hunting.asp?GotoPage=' . $page));
    if (!$raw) break;
    preg_match_all('/<tr align="left" valign="middle">(.*?)<\/tr>/si', $raw, $trs);
    $found = 0;
    foreach ($trs[1] as $tr) {
        if (strpos($tr, 'go_Edit') === false) continue;
        // 셀 추출 (1px 구분선 셀 제외)
        preg_match_all('/<td[^>]*>(.*?)<\/td>/si', $tr, $tds);
        $cells = [];
        foreach ($tds[1] as $td) {
            if (strpos($td, 'space.gif') !== false && cleanText($td) === '') continue;
            $cells[] = $td;
        }
        // cells: [0]=번호 [1]=등록일 [2]=이름 [3]=제목 [4]=연령 [5]=지역 [6]=희망직종
        if (count($cells) < 7) continue;
        if (!preg_match("/go_Edit\('(\d+)'\)/", $cells[3], $idm)) continue;
        $rows[] = [
            'orig_id' => (int)$idm[1],
            'name' => cleanText($cells[2]),
            'title' => cleanText($cells[3]),
            'age' => cleanText($cells[4]),
            'region' => cleanText($cells[5]),
            'desired_job' => cleanText($cells[6]),
        ];
        $found++;
    }
    if ($found === 0) break;
    sleep(1);
}
echo '  수집: ' . count($rows) . "건\n";

// 2단계: 상세 페이지에서 본문 추출 후 DB 반영
echo "[2] 상세 본문 수집 + DB 반영\n";
foreach ($rows as $row) {
    $raw = toUtf8(fetchRaw($baseUrl . '/html/free/hunting_r.asp?no=' . $row['orig_id']));
    $content = '';
    // 본문은 colspan=3 인 class=low 셀 (첫 class=low 셀은 좌측 여백)
    if ($raw && preg_match('/<td valign="top" colspan="3" class=low>(.*?)<\/td>/si', $raw, $b)) {
        $content = trim($b[1]);
        $content = preg_replace('/<img[^>]*space\.gif[^>]*>/i', '', $content);
        $content = trim($content);
    }

    $post = Post::where('board_type', 'job_seek')->where('title', $row['title'])->first();
    if (!$post) {
        echo "  매칭 실패: #{$row['orig_id']} {$row['title']}\n";
        continue;
    }

    $bodyLen = mb_strlen(cleanText($content));
    if ($dryRun) {
        echo "  [DRY] id={$post->id} {$row['title']} | 이름={$row['name']} 연령={$row['age']} 지역={$row['region']} 직종={$row['desired_job']} 본문={$bodyLen}자\n";
    } else {
        $post->author = $row['name'];
        $post->metadata = array_merge($post->metadata ?? [], [
            'age' => $row['age'],
            'region' => $row['region'],
            'desired_job' => $row['desired_job'],
        ]);
        if ($bodyLen > 0) {
            $post->content = $content;
        }
        $post->save();
        echo "  반영: id={$post->id} {$row['title']} | {$row['name']} / {$row['age']} / {$row['region']} / {$row['desired_job']} / 본문 {$bodyLen}자\n";
    }
    sleep(1);
}

echo "\n완료\n";
