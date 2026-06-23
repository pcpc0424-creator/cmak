<?php

namespace App\Http\Controllers;

use App\Models\HeraldIssue;

class HeraldController extends Controller
{
    /**
     * CM Herald 책장(표지 썸네일 1년치 12개). 로그인 회원만 열람 (라우트 auth 미들웨어).
     */
    public function index()
    {
        $issues = HeraldIssue::published()
            ->orderByDesc('issue_date')
            ->orderByDesc('sort_order')
            ->orderByDesc('id')
            ->limit(12)
            ->get();

        return view('business.herald', compact('issues'));
    }
}
