<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * 인터넷회원/비로그인 열람 제한 게시판 (클라이언트 요구 2026-06-23)
     * CM자료방: 논문 및 연구보고서, CM해외공급사업, 수행사례, 교육 및 세미나 자료, 전문가칼럼, 기획/특집
     * 알림마당: 입찰소식
     */
    public const RESTRICTED_BOARDS = [
        'research', 'cm_overseas', 'cm_case', 'education_seminar',
        'expert_column', 'special_feature', 'news_bid',
    ];

    /**
     * 제한 게시판이면 권한 검사. 통과 못하면 안내 뷰/로그인 리다이렉트 반환, 통과면 null.
     */
    private function guardRestricted(string $boardType, array $boardConfig)
    {
        if (!in_array($boardType, self::RESTRICTED_BOARDS, true)) {
            return null;
        }

        $user = auth()->user();

        if (!$user) {
            return redirect()->guest('/cmak/login')
                ->with('error', '해당 게시판은 로그인 후 열람할 수 있습니다.');
        }

        if (!$user->canViewRestricted()) {
            return response()->view('board.restricted', [
                'boardConfig' => $boardConfig,
                'boardType' => $boardType,
            ], 403);
        }

        return null;
    }

    /**
     * 서브 페이지 - board_type별 게시글 목록 + 상세
     * 라우트에서 board_type, 뷰 경로, 메타 정보를 받아서 처리
     */
    public function index(Request $request, string $boardType, string $viewPath, array $meta = [])
    {
        $boardConfig = config('boards.' . $boardType);

        if ($blocked = $this->guardRestricted($boardType, $boardConfig ?? [])) {
            return $blocked;
        }

        $perPage = $meta['perPage'] ?? 15;

        $query = Post::where('board_type', $boardType)
            ->where('is_published', 1)
            ->whereNull('deleted_at');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $searchField = $request->input('search_field', '');

            if ($searchField === 'title') {
                $query->where('title', 'like', "%{$search}%");
            } elseif ($searchField === 'author') {
                $query->where('author', 'like', "%{$search}%");
            } elseif (str_starts_with($searchField, 'metadata.')) {
                $key = str_replace('metadata.', '', $searchField);
                $query->where('metadata->' . $key, 'like', "%{$search}%");
            } else {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            }
        }

        // config/boards.php의 fields 기반 metadata 필터링
        foreach (($boardConfig['fields'] ?? []) as $fieldKey => $field) {
            if ($request->filled($fieldKey)) {
                $query->where('metadata->' . $fieldKey, $request->input($fieldKey));
            }
        }

        if (!empty($boardConfig['thread_order'])) {
            // 원본 사이트(freeboard.asp)의 스레드 정렬(order by fb_refnum desc, fb_step asc)을
            // 복원한 sort_order(오름차순 = 원본 노출 순서)로 정렬한다.
            // 질문-답변 연결은 원본 DB 백업(original_site/cmak.mdf)의 fb_refnum/fb_step 기준이며
            // scripts/apply_free_board_order.php 로 적용됨.
            // 관리자 신규 글(sort_order = 0)은 최신 글이므로 목록 맨 위에 최신순으로 노출.
            $posts = $query->with('attachments')
                ->orderByRaw('(sort_order = 0) DESC')
                ->orderBy('sort_order')
                ->orderByDesc('published_at')
                ->paginate($perPage)
                ->withQueryString();
        } else {
            // 동일 날짜 내 순서: 크롤링이 원본 목록 순서(최신글부터)대로 삽입했으므로
            // id 오름차순이 원본 노출 순서와 일치
            $posts = $query->with('attachments')
                ->orderByDesc('published_at')
                ->orderBy('id')
                ->paginate($perPage)
                ->withQueryString();
        }

        return view($viewPath, compact('posts', 'boardType', 'boardConfig') + $meta);
    }

    /**
     * 게시글 상세
     */
    public function show(string $boardType, int $id)
    {
        $boardConfig = config('boards.' . $boardType);

        if ($blocked = $this->guardRestricted($boardType, $boardConfig ?? [])) {
            return $blocked;
        }

        $post = Post::where('board_type', $boardType)
            ->where('is_published', 1)
            ->whereNull('deleted_at')
            ->findOrFail($id);

        // 조회수 증가
        $post->increment('view_count');

        return view('board.show', compact('post', 'boardType', 'boardConfig'));
    }
}
