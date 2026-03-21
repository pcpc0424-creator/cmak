<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\MemberCompany;
use App\Models\Banner;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts' => Post::count(),
            'total_members' => MemberCompany::count(),
            'total_banners' => Banner::count(),
        ];

        $recentPosts = Post::latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentPosts'));
    }
}
