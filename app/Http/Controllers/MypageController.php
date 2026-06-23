<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MypageController extends Controller
{
    /** 마이페이지 메인(회원정보 요약) */
    public function index()
    {
        return view('auth.mypage', ['user' => Auth::user()]);
    }

    /** 회원정보 수정 폼 */
    public function editProfile()
    {
        return view('auth.profile-edit', ['user' => Auth::user()]);
    }

    /** 회원정보 수정 저장 */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone_company' => ['nullable', 'string', 'max:30'],
            'phone_mobile' => ['nullable', 'string', 'max:30'],
            'zipcode' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string', 'max:255'],
            'address_detail' => ['nullable', 'string', 'max:255'],
            'sms_agree' => ['nullable', 'boolean'],
            'email_agree' => ['nullable', 'boolean'],
        ], [], [
            'name' => '이름',
            'email' => '이메일',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_company' => $validated['phone_company'] ?? null,
            'phone_mobile' => $validated['phone_mobile'] ?? null,
            'zipcode' => $validated['zipcode'] ?? null,
            'address' => $validated['address'] ?? null,
            'address_detail' => $validated['address_detail'] ?? null,
            'sms_agree' => $request->boolean('sms_agree'),
            'email_agree' => $request->boolean('email_agree'),
        ]);

        return redirect('/cmak/mypage')->with('success', '회원정보가 수정되었습니다.');
    }

    /** 비밀번호 변경 폼 */
    public function editPassword()
    {
        return view('auth.password-edit');
    }

    /** 비밀번호 변경 저장 */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ], [
            'password.different' => '새 비밀번호는 현재 비밀번호와 달라야 합니다.',
        ], [
            'current_password' => '현재 비밀번호',
            'password' => '새 비밀번호',
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => '현재 비밀번호가 올바르지 않습니다.']);
        }

        $user->update(['password' => $request->input('password')]);

        return redirect('/cmak/mypage')->with('success', '비밀번호가 변경되었습니다.');
    }

    /** 내가 쓴 글 */
    public function myPosts()
    {
        $posts = Post::where('created_by', Auth::id())
            ->whereNull('deleted_at')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('auth.my-posts', ['posts' => $posts]);
    }

    /** 회원 탈퇴 확인 폼 */
    public function editWithdraw()
    {
        return view('auth.withdraw');
    }

    /** 회원 탈퇴 처리 (계정 비활성화) */
    public function withdraw(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
        ], [], [
            'current_password' => '현재 비밀번호',
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => '비밀번호가 올바르지 않습니다.']);
        }

        // 계정 비활성화 (로그인 시 is_active=true 조건이므로 재로그인 불가)
        $user->update(['is_active' => false]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/cmak')->with('success', '회원 탈퇴가 완료되었습니다. 그동안 이용해 주셔서 감사합니다.');
    }
}
