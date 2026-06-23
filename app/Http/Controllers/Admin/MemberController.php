<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'member');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                  ->orWhere('username', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%");
            });
        }
        if ($request->filled('grade')) {
            $query->where('grade', $request->input('grade'));
        }
        if ($request->filled('status')) {
            $query->where('approval_status', $request->input('status'));
        }

        $members = $query->latest()->paginate(20)->withQueryString();
        $grades = User::GRADES;
        $statuses = User::APPROVAL_STATUSES;
        $statusCounts = [
            'pending' => User::where('role', 'member')->where('approval_status', 'pending')->count(),
            'approved' => User::where('role', 'member')->where('approval_status', 'approved')->count(),
            'rejected' => User::where('role', 'member')->where('approval_status', 'rejected')->count(),
        ];

        return view('admin.members.index', compact('members', 'grades', 'statuses', 'statusCounts'));
    }

    /** 가입 승인 */
    public function approve(User $member)
    {
        abort_unless($member->role === 'member', 404);

        $member->update(['approval_status' => 'approved', 'approved_at' => now()]);

        return back()->with('success', $member->name . ' 회원의 가입을 승인했습니다.');
    }

    /** 가입 반려 */
    public function reject(User $member)
    {
        abort_unless($member->role === 'member', 404);

        $member->update(['approval_status' => 'rejected']);

        return back()->with('success', $member->name . ' 회원의 가입을 반려했습니다.');
    }

    /** 회원현황 CSV 다운로드 (엑셀에서 바로 열림, UTF-8 BOM) */
    public function export(Request $request)
    {
        $query = User::where('role', 'member');
        if ($request->filled('grade')) {
            $query->where('grade', $request->input('grade'));
        }
        if ($request->filled('status')) {
            $query->where('approval_status', $request->input('status'));
        }
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                  ->orWhere('username', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%");
            });
        }
        $members = $query->latest()->get();

        $filename = 'members_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = ['No', '이름', '아이디', '이메일', '등급', '회사전화', '휴대폰', '우편번호', '주소', '상세주소', '가입상태', '활성', '가입일'];

        return response()->stream(function () use ($members, $columns) {
            $out = fopen('php://output', 'w');
            // 엑셀 한글 깨짐 방지 BOM
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, $columns);
            foreach ($members as $i => $m) {
                fputcsv($out, [
                    $i + 1,
                    $m->name,
                    $m->username,
                    $m->email,
                    $m->gradeLabel(),
                    $m->phone_company,
                    $m->phone_mobile,
                    $m->zipcode,
                    $m->address,
                    $m->address_detail,
                    $m->approvalLabel(),
                    $m->is_active ? '활성' : '비활성',
                    $m->created_at ? $m->created_at->format('Y-m-d H:i') : '',
                ]);
            }
            fclose($out);
        }, 200, $headers);
    }

    public function edit(User $member)
    {
        abort_unless($member->role === 'member', 404);

        return view('admin.members.edit', ['member' => $member, 'grades' => User::GRADES]);
    }

    public function update(Request $request, User $member)
    {
        abort_unless($member->role === 'member', 404);

        // 등급 조정은 관리자(admin)만 가능
        if (!auth()->user()->isAdmin()) {
            abort(403, '회원 등급 변경 권한이 없습니다. (관리자 전용)');
        }

        $validated = $request->validate([
            'grade' => ['required', Rule::in(array_keys(User::GRADES))],
            'is_active' => ['boolean'],
        ]);

        $member->update([
            'grade' => $validated['grade'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect(url('/admin/members'))
            ->with('success', $member->name . ' 회원 정보가 수정되었습니다.');
    }
}
