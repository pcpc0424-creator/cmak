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
        $totalPosts = Post::count();
        $totalMembers = MemberCompany::count();
        $totalBanners = Banner::count();
        $todayVisits = 0;

        $recentPosts = Post::latest()->take(10)->get();

        return view('admin.dashboard.index', compact('totalPosts', 'totalMembers', 'totalBanners', 'todayVisits', 'recentPosts'));
    }
}
