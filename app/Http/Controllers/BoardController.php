<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * 서브 페이지 - board_type별 게시글 목록 + 상세
     * 라우트에서 board_type, 뷰 경로, 메타 정보를 받아서 처리
     */
    public function index(Request $request, string $boardType, string $viewPath, array $meta = [])
    {
        $boardConfig = config('boards.' . $boardType);
        $perPage = $meta['perPage'] ?? 15;

        $query = Post::where('board_type', $boardType)
            ->where('is_published', 1)
            ->whereNull('deleted_at');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderByDesc('published_at')
            ->paginate($perPage)
            ->withQueryString();

        return view($viewPath, compact('posts', 'boardType', 'boardConfig') + $meta);
    }

    /**
     * 게시글 상세
     */
    public function show(string $boardType, int $id)
    {
        $post = Post::where('board_type', $boardType)
            ->where('is_published', 1)
            ->whereNull('deleted_at')
            ->findOrFail($id);

        // 조회수 증가
        $post->increment('view_count');

        $boardConfig = config('boards.' . $boardType);

        return view('board.show', compact('post', 'boardType', 'boardConfig'));
    }
}
