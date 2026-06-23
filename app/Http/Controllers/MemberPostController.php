<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberPostController extends Controller
{
    /** 회원이 직접 글을 쓸 수 있는 게시판(board_type) */
    public const MEMBER_BOARDS = ['job_offer', 'job_seek'];

    /** 프론트 slug → board_type */
    public const SLUG_MAP = [
        'job-offer' => 'job_offer',
        'job-seek'  => 'job_seek',
    ];

    private function resolveSlug(string $slug): string
    {
        $boardType = self::SLUG_MAP[$slug] ?? null;
        if (!$boardType) {
            abort(404, '글을 작성할 수 없는 게시판입니다.');
        }
        return $boardType;
    }

    private function guardBoard(string $boardType): void
    {
        if (!in_array($boardType, self::MEMBER_BOARDS, true)) {
            abort(403, '이 게시판에는 글을 작성할 수 없습니다.');
        }
    }

    private function guardOwner(Post $post): void
    {
        $user = Auth::user();
        if (!$user || ($post->created_by !== $user->id && !$user->isAdmin())) {
            abort(403, '본인이 작성한 글만 수정/삭제할 수 있습니다.');
        }
    }

    /** 글쓰기 폼 */
    public function create(string $slug)
    {
        $boardType = $this->resolveSlug($slug);
        $boardConfig = config('boards.' . $boardType);

        return view('member.post-form', [
            'mode' => 'create',
            'slug' => $slug,
            'boardType' => $boardType,
            'boardConfig' => $boardConfig,
            'post' => null,
        ]);
    }

    /** 글 저장 */
    public function store(string $slug, Request $request)
    {
        $boardType = $this->resolveSlug($slug);
        $this->guardBoard($boardType);
        $boardConfig = config('boards.' . $boardType);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:20480'],
        ], [], [
            'title' => '제목',
            'content' => '내용',
        ]);

        $metadata = $this->collectMetadata($boardConfig, $request);

        $post = Post::create([
            'board_type' => $boardType,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'author' => Auth::user()->name,
            'metadata' => $metadata ?: null,
            'is_published' => true,
            'published_at' => now(),
            'created_by' => Auth::id(),
        ]);

        $this->saveAttachments($post, $boardType, $request);

        return redirect('/cmak/board/' . $boardType . '/' . $post->id)
            ->with('success', '게시글이 등록되었습니다.');
    }

    /** 수정 폼 */
    public function edit(string $boardType, Post $post)
    {
        $this->guardBoard($boardType);
        $this->guardOwner($post);
        $boardConfig = config('boards.' . $boardType);
        $slug = array_search($boardType, self::SLUG_MAP, true) ?: $boardType;

        return view('member.post-form', [
            'mode' => 'edit',
            'slug' => $slug,
            'boardType' => $boardType,
            'boardConfig' => $boardConfig,
            'post' => $post,
        ]);
    }

    /** 글 수정 */
    public function update(string $boardType, Post $post, Request $request)
    {
        $this->guardBoard($boardType);
        $this->guardOwner($post);
        $boardConfig = config('boards.' . $boardType);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:20480'],
        ], [], [
            'title' => '제목',
            'content' => '내용',
        ]);

        $metadata = $this->collectMetadata($boardConfig, $request);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'metadata' => $metadata ?: null,
        ]);

        $this->saveAttachments($post, $boardType, $request);

        return redirect('/cmak/board/' . $boardType . '/' . $post->id)
            ->with('success', '게시글이 수정되었습니다.');
    }

    /** 글 삭제 (소프트 삭제) */
    public function destroy(string $boardType, Post $post, Request $request)
    {
        $this->guardBoard($boardType);
        $this->guardOwner($post);

        $post->delete();

        return redirect('/cmak/community/' . (array_search($boardType, self::SLUG_MAP, true) ?: $boardType))
            ->with('success', '게시글이 삭제되었습니다.');
    }

    /** 첨부파일 삭제 */
    public function destroyAttachment(string $boardType, Post $post, \App\Models\Attachment $attachment)
    {
        $this->guardBoard($boardType);
        $this->guardOwner($post);

        if ($attachment->attachable_id === $post->id && $attachment->attachable_type === Post::class) {
            Storage::disk('public')->delete(str_replace('storage/', '', $attachment->file_path));
            $attachment->delete();
        }

        return back()->with('success', '첨부파일이 삭제되었습니다.');
    }

    private function collectMetadata(array $boardConfig, Request $request): array
    {
        $metadata = [];
        foreach (($boardConfig['fields'] ?? []) as $key => $field) {
            $v = $request->input("meta.{$key}");
            if ($v !== null && $v !== '') {
                $metadata[$key] = $v;
            }
        }
        return $metadata;
    }

    private function saveAttachments(Post $post, string $boardType, Request $request): void
    {
        if (!$request->hasFile('attachments')) {
            return;
        }
        foreach ($request->file('attachments') as $file) {
            $path = $file->store('attachments/' . $boardType, 'public');
            if ($path === false) {
                continue;
            }
            $post->attachments()->create([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => 'storage/' . $path,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
        }
    }
}
