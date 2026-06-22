<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Support\Facades\View;

class BusinessPageController extends Controller
{
    /**
     * 협회업무 페이지를 DB(page_contents)에서 불러와 렌더링한다.
     * DB에 게시된 내용이 없으면 기존 정적 블레이드로 자동 폴백한다(안전장치).
     */
    public function show(string $slug)
    {
        $page = PageContent::bySlug($slug);

        if (!$page) {
            // 폴백: 기존 정적 페이지가 있으면 그대로 노출
            if (View::exists("business.{$slug}")) {
                return view("business.{$slug}");
            }
            abort(404);
        }

        return view('business.dynamic', compact('page'));
    }
}
