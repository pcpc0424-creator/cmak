<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Support\Facades\View;

class IntroPageController extends Controller
{
    /**
     * 협회소개 정적 페이지를 DB(page_contents)에서 불러와 렌더링한다.
     * DB에 게시된 내용이 없으면 기존 정적 블레이드로 자동 폴백한다(안전장치).
     * (회원현황·찾아오시는길·조직및구성은 별도 라우트/컨트롤러가 처리)
     */
    private const TOKENS = [
        'greeting', 'about', 'history', 'presidents', 'plan', 'departments', 'articles', 'location',
    ];

    public function show(string $token)
    {
        if (!in_array($token, self::TOKENS, true)) {
            abort(404);
        }

        $page = PageContent::bySlug("intro-{$token}");

        if (!$page) {
            if (View::exists("intro.{$token}")) {
                return view("intro.{$token}");
            }
            abort(404);
        }

        return view('intro.dynamic', compact('page'));
    }
}
