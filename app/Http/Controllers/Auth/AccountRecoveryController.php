<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * 아이디 찾기 / 비밀번호 재설정 (본인확인 기반).
 * 메일(SMTP) 미설정 환경이라 이메일 토큰 대신 이름+이메일(+아이디) 본인확인 방식.
 * 추후 SMTP 설정 시 이메일 인증 토큰 방식으로 업그레이드 가능.
 */
class AccountRecoveryController extends Controller
{
    /** 아이디 찾기 폼 */
    public function showFindUsername()
    {
        return view('auth.find-username');
    }

    /** 아이디 찾기 처리 (이름 + 이메일) */
    public function findUsername(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
        ], [], ['name' => '이름', 'email' => '이메일']);

        $user = User::where('role', 'member')
            ->where('name', $validated['name'])
            ->where('email', $validated['email'])
            ->first();

        if (!$user) {
            return back()->withInput()->withErrors(['name' => '일치하는 회원 정보가 없습니다. 이름과 이메일을 확인해 주세요.']);
        }

        return view('auth.find-username', ['foundUsername' => $this->maskUsername($user->username)]);
    }

    /** 비밀번호 재설정 폼 */
    public function showResetPassword()
    {
        return view('auth.reset-password');
    }

    /** 비밀번호 재설정 처리 (아이디 + 이름 + 이메일 본인확인 후 새 비밀번호 설정) */
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [], [
            'username' => '아이디',
            'name' => '이름',
            'email' => '이메일',
            'password' => '새 비밀번호',
        ]);

        $user = User::where('role', 'member')
            ->where('username', $validated['username'])
            ->where('name', $validated['name'])
            ->where('email', $validated['email'])
            ->first();

        if (!$user) {
            return back()->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['username' => '일치하는 회원 정보가 없습니다. 아이디·이름·이메일을 확인해 주세요.']);
        }

        $user->update(['password' => $validated['password']]);

        return redirect('/login')->with('success', '비밀번호가 재설정되었습니다. 새 비밀번호로 로그인해 주세요.');
    }

    /** 아이디 마스킹: 앞 3자만 노출, 나머지 * */
    private function maskUsername(string $username): string
    {
        $len = mb_strlen($username);
        if ($len <= 3) {
            return mb_substr($username, 0, 1) . str_repeat('*', max(1, $len - 1));
        }
        return mb_substr($username, 0, 3) . str_repeat('*', $len - 3);
    }
}
