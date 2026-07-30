<?php

namespace Database\Seeders;

use App\Models\EnglishContent;
use Illuminate\Database\Seeder;

/**
 * 관리자 영문 페이지 관리에서 빠져 있던 5개 페이지를 채운다.
 *
 * 블레이드는 이미 eng_page($slug) 로 DB 를 읽고 있었지만 english_contents 에 행이 없어
 * 항상 하드코딩 폴백만 나왔고, 관리자 목록에도 뜨지 않아 편집이 불가능했다.
 * (관리자 화면에 '페이지 추가' 기능이 없어 행을 코드로 넣어야 한다)
 *
 * title/description 은 각 블레이드의 현재 폴백값과 동일하게 넣어 화면이 바뀌지 않게 한다.
 */
class EngMissingPageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug'        => 'home',
                'section'     => 'home',
                'title'       => 'CMAK',
                'description' => 'Construction Management Association of Korea',
                'sort_order'  => 0,
            ],
            [
                'slug'        => 'about/qna',
                'section'     => 'about',
                'title'       => 'Q&A',
                'description' => 'If you have any questions, please feel free to ask us.',
                'sort_order'  => 70,
            ],
            [
                'slug'        => 'cmday/celebrations',
                'section'     => 'cmday',
                'title'       => 'Celebrations',
                'description' => 'CM case studies and materials from the International CM Day and Global CM Contest (ConsMa).',
                'sort_order'  => 25,
            ],
            [
                'slug'        => 'ipma/news',
                'section'     => 'ipma',
                'title'       => 'News & Events',
                'description' => 'Latest news and upcoming events from IPMA Korea.',
                'sort_order'  => 35,
            ],
            [
                'slug'        => 'membership',
                'section'     => 'membership',
                'title'       => 'Membership',
                'description' => 'Member firms of the Construction Management Association of Korea.',
                'sort_order'  => 0,
            ],
        ];

        foreach ($pages as $page) {
            EnglishContent::updateOrCreate(
                ['slug' => $page['slug']],
                $page + ['is_published' => true]
            );
        }
    }
}
