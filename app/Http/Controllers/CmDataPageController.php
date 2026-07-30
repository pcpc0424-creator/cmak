<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Support\Facades\View;

class CmDataPageController extends Controller
{
    /**
     * CM소개 정적 안내페이지(CM이란?·법령정보조회)를 DB(page_contents)에서 불러와 렌더링한다.
     * DB에 게시된 내용이 없으면 기존 정적 블레이드로 자동 폴백한다.
     * (CM 관련 서식, 논문/수행사례 등 = 게시판이라 대상 아님)
     */
    private const TOKENS = ['about', 'law', 'procedure', 'task-spec', 'contract'];

    public function show(string $token)
    {
        if (!in_array($token, self::TOKENS, true)) {
            abort(404);
        }

        $page = PageContent::bySlug("cm-{$token}");

        if (!$page) {
            if (View::exists("cmdata.{$token}")) {
                return view("cmdata.{$token}");
            }
            abort(404);
        }

        return view('cmdata.dynamic', compact('page'));
    }
}
