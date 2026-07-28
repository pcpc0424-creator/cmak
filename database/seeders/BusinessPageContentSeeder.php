<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Blade;

class BusinessPageContentSeeder extends Seeder
{
    /**
     * 기존 정적 협회업무 블레이드 파일의 본문을 그대로 읽어 page_contents 로 이관한다.
     * - 순수 HTML 페이지: 본문 그대로 저장
     * - @foreach/@php 가 있는 페이지(consma, slogan): 현재 출력 결과(HTML)로 펼쳐 저장
     */
    public function run(): void
    {
        // 협회업무 GNB 순서대로.
        // consma(consma_editions) / herald(herald_issues) 는 전용 컨트롤러·테이블로 관리하므로 제외.
        // sort_order 는 GNB 위치를 유지하기 위해 값을 직접 지정한다.
        $slugs = [
            'membership'    => 0,
            'certification' => 1,
            'confirm'       => 2,
            'inspection'    => 3,
            'education'     => 4,
            'slogan'        => 7,
        ];

        $base = resource_path('views/business');

        foreach ($slugs as $slug => $sortOrder) {
            $path = "{$base}/{$slug}.blade.php";
            if (!is_file($path)) {
                $this->command?->warn("건너뜀(파일 없음): {$slug}");
                continue;
            }

            $src = file_get_contents($path);

            $browserTitle = $this->section($src, 'title');
            $pageTitle    = $this->section($src, 'page-title');
            $category     = $this->section($src, 'category') ?? '협회업무';
            $categoryLink = $this->section($src, 'category-link') ?? "/cmak/business/{$slug}";

            $html = $this->extractContent($src);

            PageContent::updateOrCreate(
                ['slug' => $slug],
                [
                    'menu'          => '협회업무',
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

        // 마지막 @endsection / @stop 까지가 본문
        $endPos = strrpos($after, '@endsection');
        if ($endPos === false) {
            $endPos = strrpos($after, '@stop');
        }
        $body = $endPos !== false ? substr($after, 0, $endPos) : $after;

        // content 섹션 앞쪽(상단)에 정의된 @php 데이터 블록 수집 (consma 형태)
        preg_match_all('/@php.*?@endphp/s', $before, $pm);
        $pre = implode("\n", $pm[0]);

        $needsRender = (bool) preg_match('/@(foreach|forelse|for|if|php)\b/', $pre . $body);

        if ($needsRender) {
            // 현재 화면에 보이는 결과(HTML)로 펼쳐서 저장 → 이후 일반 편집 가능
            return trim(Blade::render($pre . "\n" . $body));
        }

        return trim($body);
    }
}
