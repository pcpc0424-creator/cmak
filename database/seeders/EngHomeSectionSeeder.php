<?php

namespace Database\Seeders;

use App\Models\EnglishContent;
use App\Models\EnglishItem;
use Illuminate\Database\Seeder;

/**
 * 영문 인덱스(II-1~II-5)의 섹션 내용을 english_items 로 옮긴다.
 *
 * 그동안 eng/home.blade.php 에 하드코딩돼 있어 관리자에서 손댈 수 없었다.
 * 값은 현재 화면과 동일하게 넣어 시딩 후에도 렌더 결과가 바뀌지 않는다.
 *
 * 타입 규칙 (블레이드가 type 으로 골라 쓴다)
 *   hero        II-1 히어로 슬라이드   tag=eyebrow, title, description, image_path, link
 *   about_head  II-2 섹션 머리말        tag=eyebrow, title, description
 *   about_card  II-2 카드 6개           tag=번호, title, description, link
 *   cmday_head  II-3 머리말·CTA         tag=eyebrow, title, description, subtitle=CTA문구, link
 *   cmday_stat  II-3 숫자 4개           title=값, subtitle=라벨
 *   news_head   II-4 머리말             tag=eyebrow, title, description
 *   news_card   II-4 카드 3개           tag=라벨, title, date_text, image_path, link
 *   quick_head  II-5 머리말             tag=eyebrow, title
 *   quick_link  II-5 링크 4개           title, description, link, tag=아이콘키
 */
class EngHomeSectionSeeder extends Seeder
{
    public function run(): void
    {
        $home = EnglishContent::where('slug', 'home')->first();
        if (!$home) {
            $this->command?->warn("english_contents 에 'home' 행이 없습니다. EngMissingPageSeeder 를 먼저 실행하세요.");
            return;
        }

        $items = [
            // ── II-1 히어로
            ['type' => 'hero', 'sort_order' => 10, 'tag' => 'CMAK · Since 1997',
             'title' => "Leading Korea's Construction Management",
             'description' => 'For nearly three decades, the Construction Management Association of Korea has been at the forefront of advancing CM practice.',
             'image_path' => '/cmak/images/eng/eng1.jpg', 'link' => '/cmak/eng/about/greeting'],

            // ── II-2 About CMAK
            ['type' => 'about_head', 'sort_order' => 100, 'tag' => 'About CMAK',
             'title' => 'The Voice of CM in Korea',
             'description' => 'Founded in 1997, CMAK represents construction management firms and professionals committed to advancing the practice and elevating industry standards across Korea.'],
            ['type' => 'about_card', 'sort_order' => 110, 'tag' => '01', 'title' => "Chairman's Message",
             'description' => 'A welcome message from the chairman of the Construction Management Association of Korea.',
             'link' => '/cmak/eng/about/greeting'],
            ['type' => 'about_card', 'sort_order' => 120, 'tag' => '02', 'title' => 'Purpose & Vision',
             'description' => 'Our mission to promote construction management as a recognized profession and advance the industry.',
             'link' => '/cmak/eng/about/purpose'],
            ['type' => 'about_card', 'sort_order' => 130, 'tag' => '03', 'title' => 'History',
             'description' => 'Nearly three decades of milestones, growth and contribution to the Korean construction industry.',
             'link' => '/cmak/eng/about/history'],
            ['type' => 'about_card', 'sort_order' => 140, 'tag' => '04', 'title' => 'Organization',
             'description' => "Meet the leadership, board of directors, committees and staff that guide CMAK's work.",
             'link' => '/cmak/eng/about/organization'],
            ['type' => 'about_card', 'sort_order' => 150, 'tag' => '05', 'title' => 'Scheme of Work',
             'description' => 'Our core programs in policy, research, education, certification and international cooperation.',
             'link' => '/cmak/eng/about/scheme'],
            ['type' => 'about_card', 'sort_order' => 160, 'tag' => '06', 'title' => 'Contact Us',
             'description' => 'Get in touch with the CMAK secretariat in Seoul, Korea — we welcome inquiries from members and partners.',
             'link' => '/cmak/eng/about/contact'],

            // ── II-3 International CM Day
            ['type' => 'cmday_head', 'sort_order' => 200, 'tag' => 'International CM Day',
             'title' => 'Celebrating Construction Management Worldwide',
             'description' => 'International CM Day brings together construction management professionals from around the globe to celebrate the value of CM and to share knowledge, achievements and best practices that shape the built environment.',
             'subtitle' => 'Learn About CM Day', 'link' => '/cmak/eng/cmday/introduction'],
            ['type' => 'cmday_stat', 'sort_order' => 210, 'title' => '29',      'subtitle' => 'Years of CMAK'],
            ['type' => 'cmday_stat', 'sort_order' => 220, 'title' => '20,000+', 'subtitle' => 'Members'],
            ['type' => 'cmday_stat', 'sort_order' => 230, 'title' => '9',       'subtitle' => 'Partner Countries'],
            ['type' => 'cmday_stat', 'sort_order' => 240, 'title' => '1997',    'subtitle' => 'Established'],

            // ── II-4 CMAK News
            ['type' => 'news_head', 'sort_order' => 300, 'tag' => 'CMAK News',
             'title' => "What's Happening at CMAK",
             'description' => 'Stay up to date with our latest publications, educations and events from CMAK and the global CM community.'],
            ['type' => 'news_card', 'sort_order' => 310, 'tag' => 'Publications', 'date_text' => 'Latest Issue',
             'title' => 'CM Herald Magazine and CMAK Annual Reports',
             'image_path' => '/cmak/images/eng/eng2.jpg', 'link' => '/cmak/eng/news/publications'],
            ['type' => 'news_card', 'sort_order' => 320, 'tag' => 'Education', 'date_text' => 'Ongoing Programs',
             'title' => 'Educations and Seminars for CM Professionals',
             'image_path' => '/cmak/images/eng/eng5.jpg', 'link' => '/cmak/eng/news/seminars'],
            ['type' => 'news_card', 'sort_order' => 330, 'tag' => 'Events', 'date_text' => 'Annual',
             'title' => 'CMAK International Conferences and Forums',
             'image_path' => '/cmak/images/eng/eng4.jpg', 'link' => '/cmak/eng/news/conferences'],

            // ── II-5 Quick Links
            ['type' => 'quick_head', 'sort_order' => 400, 'tag' => 'Quick Links', 'title' => 'Explore CMAK'],
            ['type' => 'quick_link', 'sort_order' => 410, 'tag' => 'globe', 'title' => 'IPMA Korea',
             'description' => 'International project management certification', 'link' => '/cmak/eng/ipma/about'],
            ['type' => 'quick_link', 'sort_order' => 420, 'tag' => 'certificate', 'title' => 'Certification',
             'description' => 'Become an internationally certified PM', 'link' => '/cmak/eng/ipma/certification'],
            ['type' => 'quick_link', 'sort_order' => 430, 'tag' => 'users', 'title' => 'Membership',
             'description' => 'Join the CMAK community', 'link' => '/cmak/eng/membership'],
            ['type' => 'quick_link', 'sort_order' => 440, 'tag' => 'pin', 'title' => 'Contact Us',
             'description' => 'Visit or reach out to CMAK', 'link' => '/cmak/eng/about/contact'],
        ];

        foreach ($items as $item) {
            EnglishItem::updateOrCreate(
                [
                    'english_content_id' => $home->id,
                    'type'               => $item['type'],
                    'sort_order'         => $item['sort_order'],
                ],
                $item + ['english_content_id' => $home->id, 'is_active' => true]
            );
        }
    }
}
