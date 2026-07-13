<?php
/**
 * 구 영문사이트 membership.asp 회원사 디렉터리(148개)를 english_items 에 적재.
 * 소스: scripts/data/eng_member_firms.csv (No,FirmName,Address,Tel,Fax,Web)
 * 대상: EnglishContent slug='membership' 의 items (type='member_firm')
 *
 * 실행: php scripts/import_eng_member_firms.php
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\EnglishContent;

$CSV = __DIR__ . '/data/eng_member_firms.csv';

function nn($v){ $v=trim((string)$v); return $v===''? null : $v; }

$content = EnglishContent::where('slug', 'membership')->first();
if (!$content) { fwrite(STDERR, "membership EnglishContent 없음\n"); exit(1); }

$fh = fopen($CSV, 'r');
$h = fgetcsv($fh);
$rows = [];
while (($r = fgetcsv($fh)) !== false) {
    if (count($r) < 2) continue;
    $name = nn($r[1] ?? '');
    if ($name === null) continue;
    $rows[] = [
        'name' => $name,
        'address' => nn($r[2] ?? ''),
        'tel' => nn($r[3] ?? ''),
        'fax' => nn($r[4] ?? ''),
        'web' => nn($r[5] ?? ''),
    ];
}
fclose($fh);
echo "파싱: " . count($rows) . "건\n";
if (count($rows) < 100) { fwrite(STDERR, "건수 비정상. 중단.\n"); exit(1); }

// 회사명 알파벳순 정렬 (디렉터리)
usort($rows, fn($a, $b) => strcasecmp($a['name'], $b['name']));

$now = date('Y-m-d H:i:s');
DB::transaction(function () use ($content, $rows, $now) {
    // 기존 member_firm 항목 제거(재실행 대비)
    DB::table('english_items')->where('english_content_id', $content->id)
        ->where('type', 'member_firm')->delete();
    $i = 0;
    foreach ($rows as $m) {
        DB::table('english_items')->insert([
            'english_content_id' => $content->id,
            'type'        => 'member_firm',
            'sort_order'  => ++$i,
            'title'       => $m['name'],
            'description' => $m['address'],
            'tag'         => $m['tel'],
            'date_text'   => $m['fax'],
            'link'        => $m['web'],
            'meta'        => json_encode(['tel' => $m['tel'], 'fax' => $m['fax'], 'web' => $m['web']], JSON_UNESCAPED_UNICODE),
            'is_active'   => 1,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);
    }
});

$cnt = DB::table('english_items')->where('english_content_id', $content->id)->where('type', 'member_firm')->count();
echo "적재 완료: {$cnt}건\n";
