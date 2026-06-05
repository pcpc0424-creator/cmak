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

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'published') {
                $query->where('is_published', 1);
            } elseif ($status === 'draft') {
                $query->where('is_published', 0);
            }
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->withCount('attachments')->latest()->paginate(15)->withQueryString();
        $statusCounts = [
            'all' => Post::where('board_type', $boardType)->count(),
            'published' => Post::where('board_type', $boardType)->where('is_published', 1)->count(),
            'draft' => Post::where('board_type', $boardType)->where('is_published', 0)->count(),
        ];

        return view('admin.posts.index', compact('posts', 'boardType', 'boardConfig', 'statusCounts'));
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
            'author' => ['nullable', 'string', 'max:100'],
            'summary' => ['nullable', 'string'],
            'issue_number' => ['nullable', 'string', 'max:100'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:20480'],
        ]);

        $metadata = [];
        foreach (($boardConfig['fields'] ?? []) as $key => $field) {
            $v = $request->input("meta.{$key}");
            if ($v !== null && $v !== '') {
                $metadata[$key] = $v;
            }
        }

        $post = Post::create([
            'board_type' => $boardType,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'author' => $validated['author'] ?? null,
            'summary' => $validated['summary'] ?? null,
            'issue_number' => $validated['issue_number'] ?? null,
            'metadata' => $metadata ?: null,
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? now() : null,
            'created_by' => Auth::id(),
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments/' . $boardType, 'public');
                if ($path === false) {
                    return redirect($this->basePath . '/admin/posts/' . $boardType)
                        ->with('error', '첨부파일 저장에 실패했습니다: ' . $file->getClientOriginalName());
                }
                $post->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => 'storage/' . $path,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ]);
            }
        }

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
            'author' => ['nullable', 'string', 'max:100'],
            'summary' => ['nullable', 'string'],
            'issue_number' => ['nullable', 'string', 'max:100'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:20480'],
        ]);

        $wasPublished = $post->is_published;
        $isPublished = $request->boolean('is_published');

        $metadata = [];
        foreach (($boardConfig['fields'] ?? []) as $key => $field) {
            $v = $request->input("meta.{$key}");
            if ($v !== null && $v !== '') {
                $metadata[$key] = $v;
            }
        }

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'author' => $validated['author'] ?? $post->author,
            'summary' => $validated['summary'] ?? null,
            'issue_number' => $validated['issue_number'] ?? null,
            'metadata' => $metadata ?: null,
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $isPublished,
            'published_at' => ($isPublished && !$wasPublished) ? now() : $post->published_at,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments/' . $boardType, 'public');
                if ($path === false) {
                    return redirect($this->basePath . '/admin/posts/' . $boardType)
                        ->with('error', '첨부파일 저장에 실패했습니다: ' . $file->getClientOriginalName());
                }
                $post->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => 'storage/' . $path,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ]);
            }
        }

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

    public function destroyAttachment(string $boardType, Post $post, \App\Models\Attachment $attachment)
    {
        if ($attachment->attachable_id === $post->id && $attachment->attachable_type === Post::class) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('storage/', '', $attachment->file_path));
            $attachment->delete();
        }

        return redirect($this->basePath . '/admin/posts/' . $boardType . '/' . $post->id . '/edit')
            ->with('success', '첨부파일이 삭제되었습니다.');
    }
}
