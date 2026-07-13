<?php
/**
 * 구 영문 게시판 4종(크롤 CSV)을 english_items 에 적재.
 * 소스 CSV: scripts/data/eng_board_<key>.csv  (no,title,date,attach_local,attach_orig)
 * 첨부 파일: public/eng/uploads/<key>/<attach_local>
 *
 * 실행: php scripts/import_eng_boards.php
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\EnglishContent;

$MAP = [
    'publications' => ['slug' => 'news/publications', 'type' => 'publication'],
    'seminars'     => ['slug' => 'news/seminars',     'type' => 'program'],
    'conferences'  => ['slug' => 'news/conferences',  'type' => 'event'],
    'celebrations' => ['slug' => 'cmday/celebrations', 'type' => 'gallery'],
];
$IMG_EXT = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

function nn($v){ $v=trim((string)$v); return $v===''? null : $v; }

$now = date('Y-m-d H:i:s');
foreach ($MAP as $key => $cfg) {
    $csv = __DIR__ . "/data/eng_board_{$key}.csv";
    if (!is_file($csv)) { echo "[$key] CSV 없음, 건너뜀\n"; continue; }
    $content = EnglishContent::where('slug', $cfg['slug'])->first();
    if (!$content) { echo "[$key] EnglishContent({$cfg['slug']}) 없음, 건너뜀\n"; continue; }

    $fh = fopen($csv, 'r');
    $h = fgetcsv($fh);
    $rows = [];
    while (($r = fgetcsv($fh)) !== false) {
        if (count($r) < 3) continue;
        $no = (int)($r[0] ?? 0);
        $title = nn($r[1] ?? '');
        if ($title === null) continue;
        $date = nn($r[2] ?? '');
        $local = nn($r[3] ?? '');
        $rows[] = ['no' => $no, 'title' => $title, 'date' => $date, 'local' => $local];
    }
    fclose($fh);

    DB::transaction(function () use ($content, $cfg, $rows, $now, $key, $IMG_EXT) {
        // 기존 이관분 제거(재실행 대비): 같은 type 삭제
        DB::table('english_items')->where('english_content_id', $content->id)
            ->where('type', $cfg['type'])->delete();
        $i = 0;
        foreach ($rows as $m) {   // CSV는 최신순 → 그대로 sort_order
            $ext = strtolower(pathinfo($m['local'] ?? '', PATHINFO_EXTENSION));
            $fileUrl = $m['local'] ? "/cmak/eng_uploads/{$key}/{$m['local']}" : null;
            $isImg = $m['local'] && in_array($ext, $IMG_EXT, true);
            DB::table('english_items')->insert([
                'english_content_id' => $content->id,
                'type'        => $cfg['type'],
                'sort_order'  => ++$i,
                'title'       => $m['title'],
                'date_text'   => $m['date'],
                'image_path'  => $isImg ? $fileUrl : null,
                'link'        => $fileUrl,
                'tag'         => $ext ? strtoupper($ext) : null,
                'meta'        => json_encode(['no' => $m['no'], 'file' => $m['local']], JSON_UNESCAPED_UNICODE),
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }
    });
    $cnt = DB::table('english_items')->where('english_content_id', $content->id)->where('type', $cfg['type'])->count();
    echo "[$key] → {$cfg['slug']} ({$cfg['type']}): {$cnt}건 적재\n";
}
echo "완료\n";
