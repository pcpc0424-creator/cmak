<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'min:6', 'max:30', 'alpha_dash', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone_company' => ['nullable', 'string', 'max:30'],
            'phone_mobile' => ['nullable', 'string', 'max:30'],
            'sms_agree' => ['nullable', 'boolean'],
            'email_agree' => ['nullable', 'boolean'],
            'zipcode' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string', 'max:255'],
            'address_detail' => ['nullable', 'string', 'max:255'],
            'join_period' => ['nullable', 'string', 'max:50'],
            'agree_terms' => ['accepted'],
            'agree_privacy' => ['accepted'],
        ], [], [
            'name' => '이름',
            'username' => '사용자ID',
            'password' => '비밀번호',
            'email' => '이메일',
            'agree_terms' => '이용약관 동의',
            'agree_privacy' => '개인정보처리방침 동의',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'], // 모델 cast(hashed)로 자동 해시
            'role' => 'member',
            'grade' => 'internet', // 가입 시 기본 등급(인터넷회원). 승급은 관리자만 가능.
            'phone_company' => $validated['phone_company'] ?? null,
            'phone_mobile' => $validated['phone_mobile'] ?? null,
            'sms_agree' => $request->boolean('sms_agree'),
            'email_agree' => $request->boolean('email_agree'),
            'zipcode' => $validated['zipcode'] ?? null,
            'address' => $validated['address'] ?? null,
            'address_detail' => $validated['address_detail'] ?? null,
            'join_period' => $validated['join_period'] ?? null,
            'is_active' => true,
            'approval_status' => 'pending', // 관리자 승인 후 로그인 가능
        ]);

        // 승인 전에는 로그인 불가 → 자동 로그인하지 않고 안내 페이지로 이동
        return redirect('/login')->with('success',
            '회원가입 신청이 완료되었습니다. 관리자 승인 후 로그인하실 수 있습니다.');
    }

    public function checkUsername(Request $request)
    {
        $username = (string) $request->query('username', '');
        $available = strlen($username) >= 6
            && preg_match('/^[A-Za-z0-9_-]+$/', $username)
            && !User::where('username', $username)->exists();

        return response()->json(['available' => $available]);
    }
}
