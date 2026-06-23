<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login_id' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [], [
            'login_id' => '아이디',
            'password' => '비밀번호',
        ]);

        // 아이디(username) 또는 이메일 모두 허용
        $field = filter_var($credentials['login_id'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $attempt = [
            $field => $credentials['login_id'],
            'password' => $credentials['password'],
            'is_active' => true,
        ];

        if (Auth::attempt($attempt, $request->boolean('remember'))) {
            $user = Auth::user();

            // 관리자/임직원은 승인 절차와 무관, 일반 회원은 승인 상태 확인
            if ($user->isMember() && !$user->isApproved()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $msg = $user->approval_status === 'rejected'
                    ? '회원가입이 반려되었습니다. 자세한 사항은 협회로 문의해 주세요.'
                    : '아직 가입 승인 대기 중입니다. 관리자 승인 후 로그인하실 수 있습니다.';

                throw ValidationException::withMessages(['login_id' => $msg]);
            }

            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
            'login_id' => '아이디 또는 비밀번호가 올바르지 않습니다.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
