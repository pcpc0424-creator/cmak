<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Blade;

/**
 * 협회소개(intro) · CM소개(cmdata) 정적 페이지의 본문을 page_contents 로 이관하여
 * 관리자에서 편집 가능하도록 활성화한다.
 * - 순수 HTML 페이지: 본문 그대로 저장
 * - @foreach/@php 가 있는 페이지: 현재 출력 결과(HTML)로 펼쳐 저장(이후 일반 편집 가능)
 * 정적 원본 블레이드는 보존되며, 미게시 시 컨트롤러가 정적 파일로 자동 폴백한다.
 */
class IntroCmPageContentSeeder extends Seeder
{
    public function run(): void
    {
        // 협회소개: 회원현황(members, 실시간 데이터)·찾아오시는길(location, 지도)·조직및구성(org, 별도관리)은 제외.
        // [뷰토큰 => [슬러그, 정렬]]  사이트맵 순서 유지.
        $intro = [
            'greeting'    => ['intro-greeting',    10],
            'about'       => ['intro-about',       20],
            'history'     => ['intro-history',     30],
            'presidents'  => ['intro-presidents',  50],
            'plan'        => ['intro-plan',         60],
            'departments' => ['intro-departments',  80],
            'articles'    => ['intro-articles',     90],
        ];

        // CM소개: CM이란?(about) · 법령정보조회(law) 정적 안내페이지만.
        // (CM가이드=게시판, 업무절차서/과업내용서/표준계약서=통합예정 고아페이지 → 제외)
        $cm = [
            'about' => ['cm-about', 0],
            'law'   => ['cm-law',   40],
        ];

        $this->import(resource_path('views/intro'),  $intro, '협회소개');
        $this->import(resource_path('views/cmdata'), $cm,    'CM 소개');

        // 조직및구성 4개 탭을 협회소개 순서(주요연혁 다음)에 오도록 재배치.
        $orgOrder = ['org-chart' => 40, 'org-executives' => 41, 'org-branches' => 42, 'org-committees' => 43];
        foreach ($orgOrder as $slug => $sort) {
            PageContent::where('slug', $slug)->update(['sort_order' => $sort]);
        }
    }

    private function import(string $dir, array $pages, string $menu): void
    {
        foreach ($pages as $token => [$slug, $sortOrder]) {
            $path = "{$dir}/{$token}.blade.php";
            if (!is_file($path)) {
                $this->command?->warn("건너뜀(파일 없음): {$token}");
                continue;
            }

            $src = file_get_contents($path);

            $browserTitle = $this->section($src, 'title');
            $pageTitle    = $this->section($src, 'page-title');
            $category     = $this->section($src, 'category') ?? $menu;
            $categoryLink = $this->section($src, 'category-link');
            $html         = $this->extractContent($src);

            PageContent::updateOrCreate(
                ['slug' => $slug],
                [
                    'menu'          => $menu,
                    'page_title'    => $pageTitle,
                    'browser_title' => $browserTitle,
                    'category'      => $category,
                    'category_link' => $categoryLink,
                    'content'       => $html,
                    'is_published'  => true,
                    'sort_order'    => $sortOrder,
                ]
            );

            $this->command?->info("이관 완료: {$slug} (" . mb_strlen($html) . "자)");
        }
    }

    /** @section('name', '값') 한 줄 형태에서 값 추출 */
    private function section(string $src, string $name): ?string
    {
        if (preg_match("/@section\('" . preg_quote($name, '/') . "',\s*'(.*?)'\)/s", $src, $m)) {
            return $m[1];
        }
        return null;
    }

    /** content 섹션 본문을 추출. 동적(@foreach/@php) 페이지는 현재 출력 HTML로 렌더링 */
    private function extractContent(string $src): string
    {
        $marker = "@section('content')";
        $pos = strpos($src, $marker);
        if ($pos === false) {
            return '';
        }

        $before = substr($src, 0, $pos);
        $after  = substr($src, $pos + strlen($marker));

        $endPos = strrpos($after, '@endsection');
        if ($endPos === false) {
            $endPos = strrpos($after, '@stop');
        }
        $body = $endPos !== false ? substr($after, 0, $endPos) : $after;

        // content 섹션 앞쪽에 정의된 @php 데이터 블록 수집(루프 데이터가 상단에 있는 형태)
        preg_match_all('/@php.*?@endphp/s', $before, $pm);
        $pre = implode("\n", $pm[0]);

        $needsRender = (bool) preg_match('/@(foreach|forelse|for|if|php)\b/', $pre . $body);

        if ($needsRender) {
            return trim(Blade::render($pre . "\n" . $body));
        }

        return trim($body);
    }
}
