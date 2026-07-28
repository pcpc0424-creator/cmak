<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Blade;

/**
 * 앞서 IntroCmPageContentSeeder 에서 제외했던 나머지 국문 정적 페이지를 편집형으로 활성화.
 * - privacy(개인정보처리방침)
 * - intro-location(찾아오시는 길, 구글맵 iframe 포함 → 편집기에서 iframe 허용 설정 적용됨)
 * - cm-procedure / cm-task-spec / cm-contract(CM업무절차서/표준과업내용서/표준계약서)
 * 정적 원본 블레이드는 보존되며 미게시 시 컨트롤러가 정적 파일로 폴백한다.
 */
class RemainingStaticPageSeeder extends Seeder
{
    public function run(): void
    {
        // [슬러그 => [블레이드경로, 메뉴, 카테고리, 카테고리링크, 정렬]]
        $pages = [
            'privacy' => [
                resource_path('views/privacy.blade.php'),
                '약관/정책', '개인정보처리방침', '/privacy', 10,
            ],
            'intro-location' => [
                resource_path('views/intro/location.blade.php'),
                '협회소개', '협회소개', '/cmak/intro/location', 95,
            ],
            'cm-procedure' => [
                resource_path('views/cmdata/procedure.blade.php'),
                'CM 소개', 'CM 소개', '/cmak/cmdata/procedure', 10,
            ],
            'cm-task-spec' => [
                resource_path('views/cmdata/task-spec.blade.php'),
                'CM 소개', 'CM 소개', '/cmak/cmdata/task-spec', 20,
            ],
            'cm-contract' => [
                resource_path('views/cmdata/contract.blade.php'),
                'CM 소개', 'CM 소개', '/cmak/cmdata/contract', 30,
            ],
        ];

        foreach ($pages as $slug => [$path, $menu, $category, $categoryLink, $sortOrder]) {
            if (!is_file($path)) {
                $this->command?->warn("건너뜀(파일 없음): {$slug}");
                continue;
            }

            $src = file_get_contents($path);

            PageContent::updateOrCreate(
                ['slug' => $slug],
                [
                    'menu'          => $menu,
                    'page_title'    => $this->section($src, 'page-title') ?: $slug,
                    'browser_title' => $this->section($src, 'title'),
                    'category'      => $this->section($src, 'category') ?: $category,
                    'category_link' => $this->section($src, 'category-link') ?: $categoryLink,
                    'content'       => $this->extractContent($src),
                    'is_published'  => true,
                    'sort_order'    => $sortOrder,
                ]
            );

            $this->command?->info("이관 완료: {$slug}");
        }
    }

    private function section(string $src, string $name): ?string
    {
        if (preg_match("/@section\('" . preg_quote($name, '/') . "',\s*'(.*?)'\)/s", $src, $m)) {
            return $m[1];
        }
        // 큰따옴표 형태도 지원(예: @section('title', "...")))
        if (preg_match("/@section\('" . preg_quote($name, '/') . "',\s*\"(.*?)\"\)/s", $src, $m)) {
            return $m[1];
        }
        return null;
    }

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

        preg_match_all('/@php.*?@endphp/s', $before, $pm);
        $pre = implode("\n", $pm[0]);

        $needsRender = (bool) preg_match('/@(foreach|forelse|for|if|php)\b/', $pre . $body);

        if ($needsRender) {
            return trim(Blade::render($pre . "\n" . $body));
        }

        return trim($body);
    }
}
