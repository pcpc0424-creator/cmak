<?php
/**
 * 자유게시판 원본 스레드 순서 복원 적용 스크립트
 *
 * 근거 데이터:
 *  - original_site/cmak.mdf (2009-12-24 SQL Server 백업)의 free_board 테이블
 *    → fb_refnum/fb_step/fb_level (원본 정렬: order by fb_refnum desc, fb_step asc)
 *  - 2010년 이후 글: 1차 크롤(id 44575~44687) 순서 = 원본 리스트 순서
 *    + 누락 답변(45759~45777 등)을 내용 대조로 해당 질문 아래 삽입
 *
 * 입력: /tmp/free_board_plan.json (sort: [{id, sort_order, meta, author}], dups: [id])
 * 적용:
 *  - posts.sort_order  : 원본 리스트 순서 (오름차순 = 원본 노출 순서)
 *  - posts.metadata    : fb_num/fb_refnum/fb_step/reply_level/is_reply
 *  - posts.author      : mdf fb_name (비어있는 경우만)
 *  - 중복 크롤 게시글  : is_published = false
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Post;
use Illuminate\Support\Facades\DB;

$plan = json_decode(file_get_contents('/tmp/free_board_plan.json'), true);
if (!$plan) {
    fwrite(STDERR, "plan 파일을 읽을 수 없습니다\n");
    exit(1);
}

DB::transaction(function () use ($plan) {
    $updated = 0;
    foreach ($plan['sort'] as $row) {
        $post = Post::where('board_type', 'free_board')->find($row['id']);
        if (!$post) {
            fwrite(STDERR, "누락 id {$row['id']}\n");
            continue;
        }
        $post->sort_order = $row['sort_order'];
        $post->metadata = array_merge($post->metadata ?? [], $row['meta']);
        if (!empty($row['author']) && empty($post->author)) {
            $post->author = $row['author'];
        }
        $post->save();
        $updated++;
    }

    $hidden = Post::where('board_type', 'free_board')
        ->whereIn('id', $plan['dups'])
        ->update(['is_published' => false]);

    echo "정렬/메타 갱신: {$updated}건, 중복 비노출 처리: {$hidden}건\n";
});
