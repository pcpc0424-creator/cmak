<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected string $basePath = '';

    public function index(string $boardType, Request $request)
    {
        $boardConfig = config('boards.' . $boardType);

        if (!$boardConfig) {
            abort(404, '존재하지 않는 게시판입니다.');
        }

        $query = Post::where('board_type', $boardType);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->withCount('attachments')->latest()->paginate(15)->withQueryString();

        return view('admin.posts.index', compact('posts', 'boardType', 'boardConfig'));
    }

    public function create(string $boardType)
    {
        $boardConfig = config('boards.' . $boardType);

        if (!$boardConfig) {
            abort(404, '존재하지 않는 게시판입니다.');
        }

        return view('admin.posts.create', compact('boardType', 'boardConfig'));
    }

    public function store(string $boardType, Request $request)
    {
        $boardConfig = config('boards.' . $boardType);

        if (!$boardConfig) {
            abort(404, '존재하지 않는 게시판입니다.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $validated['board_type'] = $boardType;
        $validated['created_by'] = Auth::id();

        Post::create($validated);

        return redirect($this->basePath . '/admin/posts/' . $boardType)
            ->with('success', '게시글이 등록되었습니다.');
    }

    public function edit(string $boardType, Post $post)
    {
        $boardConfig = config('boards.' . $boardType);

        if (!$boardConfig) {
            abort(404, '존재하지 않는 게시판입니다.');
        }

        return view('admin.posts.edit', compact('post', 'boardType', 'boardConfig'));
    }

    public function update(string $boardType, Request $request, Post $post)
    {
        $boardConfig = config('boards.' . $boardType);

        if (!$boardConfig) {
            abort(404, '존재하지 않는 게시판입니다.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $post->update($validated);

        return redirect($this->basePath . '/admin/posts/' . $boardType)
            ->with('success', '게시글이 수정되었습니다.');
    }

    public function destroy(string $boardType, Post $post)
    {
        $boardConfig = config('boards.' . $boardType);

        if (!$boardConfig) {
            abort(404, '존재하지 않는 게시판입니다.');
        }

        $post->delete();

        return redirect($this->basePath . '/admin/posts/' . $boardType)
            ->with('success', '게시글이 삭제되었습니다.');
    }
}
