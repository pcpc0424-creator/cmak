<?php

namespace App\Http\Controllers;

use App\Models\EnglishContent;
use Illuminate\Support\Facades\View;

class EngPageController extends Controller
{
    /**
     * 영문 정적 페이지를 EnglishContent(DB)에서 불러와 렌더링한다.
     * 게시된 내용(content)이 없으면 기존 정적 블레이드로 자동 폴백한다.
     * 편집은 기존 영문관리 시스템(/admin/english-contents)에서 content 필드로 한다.
     */
    private const SECTIONS = [
        'about' => [
            'label' => 'About CMAK',
            'side'  => 'eng.about._side',
            'pages' => ['greeting', 'purpose', 'history', 'organization', 'scheme', 'contact'],
        ],
        'cmday' => [
            'label' => 'International CM Day',
            'side'  => 'eng.cmday._side',
            'pages' => ['introduction', 'members', 'registration'],
        ],
        'ipma' => [
            'label' => 'IPMA Korea',
            'side'  => 'eng.ipma._side',
            'pages' => ['about', 'certification', 'education', 'membership', 'resources'],
        ],
    ];

    public function show(string $section, string $name)
    {
        if (!isset(self::SECTIONS[$section]) || !in_array($name, self::SECTIONS[$section]['pages'], true)) {
            abort(404);
        }

        $cfg  = self::SECTIONS[$section];
        $slug = "{$section}/{$name}";
        $page = EnglishContent::bySlug($slug);

        // DB 게시본(본문)이 없으면 기존 정적 페이지로 폴백
        if (!$page || !filled($page->content)) {
            $view = "eng.{$section}.{$name}";
            return View::exists($view) ? view($view) : abort(404);
        }

        return view('eng.dynamic', [
            'page'         => $page,
            'category'     => $cfg['label'],
            'categoryLink' => url("/eng/{$section}"),
            'sideMenu'     => $cfg['side'],
        ]);
    }
}
