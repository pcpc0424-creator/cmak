<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

/**
 * 조직 및 구성(intro/organization) 4개 탭을 page_contents 편집형으로 시딩한다.
 *  - org-chart       기구표  : 기존 조직도 이미지(원본 동일)
 *  - org-executives  집행부  : 임원 명단 표(편집형 빈 구조 — 관리자에서 직접 입력)
 *  - org-branches    지회    : 원본 지회 이미지
 *  - org-committees  위원회  : 원본 위원회 구성 이미지
 *
 * 메뉴는 '협회소개'. category-link 는 /cmak/intro/organization 으로 고정.
 * 기존 글이 있으면 덮어쓰지 않는다(updateOrCreate 의 slug 기준, 본문은 신규시에만).
 */
class OrganizationPageContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->pages() as $page) {
            PageContent::firstOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }

    private function pages(): array
    {
        $base = '/cmak/images/intro/org';
        $cat = '협회소개';
        $catLink = '/cmak/intro/organization';

        return [
            // ── 기구표 ───────────────────────────────────────────────
            [
                'slug'          => 'org-chart',
                'menu'          => $cat,
                'page_title'    => '기구표',
                'browser_title' => '조직도 - 한국CM협회',
                'category'      => '협회소개',
                'category_link' => $catLink,
                'is_published'  => true,
                'sort_order'    => 1,
                'content'       => <<<HTML
<div class="sub-content-card">
    <h2 class="sub-content-title">기구표</h2>
    <div class="sub-section" style="text-align:center; margin-top:20px;">
        <img src="{$base}/intro2_3img1i.gif" alt="조직도 상단 - 총회, 회장, 이사회, 상임이사, 감사, 고문·자문위원회, 분야별 위원회, 전국지회" style="max-width:100%;">
        <img src="{$base}/intro2_3img1j.gif" alt="조직도 하단 - 운영지원본부, 정책사업본부, 교육훈련본부, 사업지원본부, 건설산업연구센터" style="max-width:100%;">
    </div>
</div>
HTML,
            ],

            // ── 집행부 (편집형 빈 구조) ──────────────────────────────
            [
                'slug'          => 'org-executives',
                'menu'          => $cat,
                'page_title'    => '집행부',
                'browser_title' => '집행부 - 한국CM협회',
                'category'      => '협회소개',
                'category_link' => $catLink,
                'is_published'  => true,
                'sort_order'    => 2,
                'content'       => <<<'HTML'
<div class="sub-content-card">
    <h2 class="sub-content-title">집행부</h2>
    <div class="sub-section" style="margin-top:20px;">
        <p style="margin-bottom:16px; color:#555;">한국CM협회 집행부 임원 명단입니다.</p>
        <table style="width:100%; border-collapse:collapse;" border="1" cellpadding="10">
            <thead>
                <tr style="background:#f5f7fa;">
                    <th style="border:1px solid #ddd; padding:10px; width:25%;">직위</th>
                    <th style="border:1px solid #ddd; padding:10px; width:30%;">성명</th>
                    <th style="border:1px solid #ddd; padding:10px;">소속</th>
                </tr>
            </thead>
            <tbody>
                <tr><td style="border:1px solid #ddd; padding:10px; text-align:center;">회장</td><td style="border:1px solid #ddd; padding:10px;">&nbsp;</td><td style="border:1px solid #ddd; padding:10px;">&nbsp;</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px; text-align:center;">부회장</td><td style="border:1px solid #ddd; padding:10px;">&nbsp;</td><td style="border:1px solid #ddd; padding:10px;">&nbsp;</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px; text-align:center;">이사</td><td style="border:1px solid #ddd; padding:10px;">&nbsp;</td><td style="border:1px solid #ddd; padding:10px;">&nbsp;</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px; text-align:center;">감사</td><td style="border:1px solid #ddd; padding:10px;">&nbsp;</td><td style="border:1px solid #ddd; padding:10px;">&nbsp;</td></tr>
            </tbody>
        </table>
        <p style="margin-top:12px; font-size:13px; color:#888;">※ 소속 가나다 순</p>
    </div>
</div>
HTML,
            ],

            // ── 지회 ─────────────────────────────────────────────────
            [
                'slug'          => 'org-branches',
                'menu'          => $cat,
                'page_title'    => '지회',
                'browser_title' => '지회 - 한국CM협회',
                'category'      => '협회소개',
                'category_link' => $catLink,
                'is_published'  => true,
                'sort_order'    => 3,
                'content'       => <<<HTML
<div class="sub-content-card">
    <h2 class="sub-content-title">지회</h2>
    <div class="sub-section" style="text-align:center; margin-top:20px;">
        <img src="{$base}/iorg2_img1.gif" alt="전국지회" style="max-width:100%; margin-bottom:20px;">
        <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:20px;">
            <img src="{$base}/iorg2_img2.gif" alt="지회" style="max-width:100%;">
            <img src="{$base}/iorg2_img3.gif" alt="지회" style="max-width:100%;">
            <img src="{$base}/iorg2_img4.gif" alt="지회" style="max-width:100%;">
            <img src="{$base}/iorg2_img5.gif" alt="지회" style="max-width:100%;">
            <img src="{$base}/iorg2_img6.gif" alt="지회" style="max-width:100%;">
            <img src="{$base}/iorg2_img7.gif" alt="지회" style="max-width:100%;">
        </div>
    </div>
</div>
HTML,
            ],

            // ── 위원회 ───────────────────────────────────────────────
            [
                'slug'          => 'org-committees',
                'menu'          => $cat,
                'page_title'    => '위원회',
                'browser_title' => '위원회 - 한국CM협회',
                'category'      => '협회소개',
                'category_link' => $catLink,
                'is_published'  => true,
                'sort_order'    => 4,
                'content'       => <<<HTML
<div class="sub-content-card">
    <h2 class="sub-content-title">위원회</h2>
    <div class="sub-section" style="text-align:center; margin-top:20px;">
        <div style="display:flex; flex-direction:column; align-items:center; gap:24px;">
            <img src="{$base}/intro2_3img4a1.gif" alt="위원회" style="max-width:100%;">
            <img src="{$base}/intro2_3img4b1.gif" alt="위원회" style="max-width:100%;">
            <img src="{$base}/intro2_3img4c1.gif" alt="위원회" style="max-width:100%;">
            <img src="{$base}/intro2_3img4d1.gif" alt="위원회" style="max-width:100%;">
            <img src="{$base}/intro2_3img4e1.gif" alt="위원회" style="max-width:100%;">
            <img src="{$base}/intro2_3img4f1.gif" alt="위원회" style="max-width:100%;">
            <img src="{$base}/intro2_3img4g.gif" alt="위원회" style="max-width:100%;">
            <img src="{$base}/intro2_3img4h.gif" alt="위원회" style="max-width:100%;">
        </div>
    </div>
</div>
HTML,
            ],
        ];
    }
}
