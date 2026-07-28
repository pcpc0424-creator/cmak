<?php

namespace Database\Seeders;

use App\Models\EnglishContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Blade;

/**
 * 정적 영문 페이지 14개의 본문을 EnglishContent(content 필드)로 이관하여
 * 기존 영문관리 시스템(/admin/english-contents)에서 편집 가능하게 한다.
 * - 라우트는 EngPageController 경유 → 게시본 있으면 eng.dynamic, 없으면 정적 폴백.
 * - 본문 상단 @php($timeline 등) + eng_page() 컨텍스트를 함께 렌더링해 현재 화면 HTML로 펼쳐 저장.
 */
class EngPageContentSeeder extends Seeder
{
    /** slug => [section, title, sort_order] */
    private const PAGES = [
        'about/greeting'      => ['about', "Chairman's Message",       10],
        'about/purpose'       => ['about', 'Purpose of Establishment', 20],
        'about/history'       => ['about', 'History',                  30],
        'about/organization'  => ['about', 'Organization',             40],
        'about/scheme'        => ['about', 'Scheme of Work',           50],
        'about/contact'       => ['about', 'Contact Us',               60],
        'cmday/introduction'  => ['cmday', 'Introduction',             10],
        'cmday/members'       => ['cmday', 'Participating Members',    20],
        'cmday/registration'  => ['cmday', 'Registration',            30],
        'ipma/about'          => ['ipma',  'About IPMA Korea',         10],
        'ipma/certification'  => ['ipma',  'Certification',            20],
        'ipma/education'      => ['ipma',  'Education',                30],
        'ipma/membership'     => ['ipma',  'Membership',               40],
        'ipma/resources'      => ['ipma',  'Resources',                50],
    ];

    public function run(): void
    {
        foreach (self::PAGES as $slug => [$section, $title, $sortOrder]) {
            $path = resource_path('views/eng/' . $slug . '.blade.php');
            if (!is_file($path)) {
                $this->command?->warn("건너뜀(파일 없음): {$slug}");
                continue;
            }

            $src         = file_get_contents($path);
            $description = $this->section($src, 'description'); // 보통 없음
            $html        = $this->extractContent($src);

            EnglishContent::updateOrCreate(
                ['slug' => $slug],
                [
                    'section'      => $section,
                    'title'        => $title,
                    'description'  => $description,
                    'content'      => $html,
                    'is_published' => true,
                    'sort_order'   => $sortOrder,
                ]
            );

            $this->command?->info("이관 완료: {$slug} (" . mb_strlen($html) . "자)");
        }
    }

    private function section(string $src, string $name): ?string
    {
        if (preg_match("/@section\('" . preg_quote($name, '/') . "',\s*'(.*?)'\)/s", $src, $m)) {
            return $m[1];
        }
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

        // 상단 @php 블록(타임라인 데이터·eng_page 등) 수집 → 함께 렌더링
        preg_match_all('/@php.*?@endphp/s', $before, $pm);
        $pre = implode("\n", $pm[0]);

        $needsRender = (bool) preg_match('/@(foreach|forelse|for|if|php)\b/', $pre . $body)
            || str_contains($body, '{{') || str_contains($body, '{!!');

        if ($needsRender) {
            return trim(Blade::render($pre . "\n" . $body, ['page' => null]));
        }

        return trim($body);
    }
}
