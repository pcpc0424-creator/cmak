<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'company_name' => ['nullable', 'string', 'max:255'],
            'is_member_company' => ['nullable', 'boolean'],
            'department' => ['nullable', 'string', 'max:100'],
            'position' => ['nullable', 'string', 'max:100'],
            'phone_company' => ['nullable', 'string', 'max:30'],
            'phone_mobile' => ['required', 'string', 'max:30'],
            'sms_agree' => ['nullable', 'boolean'],
            'email_agree' => ['nullable', 'boolean'],
            'zipcode' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string', 'max:255'],
            'address_detail' => ['nullable', 'string', 'max:255'],
            'agree_terms' => ['accepted'],
            'agree_privacy' => ['accepted'],
        ], [], [
            'name' => '이름',
            'username' => '사용자ID',
            'password' => '비밀번호',
            'email' => '이메일',
            'phone_mobile' => '휴대전화',
            'agree_terms' => '이용약관 동의',
            'agree_privacy' => '개인정보처리방침 동의',
        ]);

        // 회원사 소속이면 회원사명으로 member_companies 매칭
        $isMemberCompany = $request->boolean('is_member_company');
        $memberCompanyId = null;
        if ($isMemberCompany && !empty($validated['company_name'])) {
            $memberCompanyId = \App\Models\MemberCompany::where('is_active', true)
                ->where('company_name', $validated['company_name'])
                ->value('id');
        }

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'], // 모델 cast(hashed)로 자동 해시
            'role' => 'member',
            'grade' => 'internet', // 가입 시 기본 등급(인터넷회원). 승급은 관리자만 가능.
            'company_name' => $validated['company_name'] ?? null,
            'is_member_company' => $isMemberCompany,
            'member_company_id' => $memberCompanyId,
            'department' => $validated['department'] ?? null,
            'position' => $validated['position'] ?? null,
            'phone_company' => $validated['phone_company'] ?? null,
            'phone_mobile' => $validated['phone_mobile'] ?? null,
            'sms_agree' => $request->boolean('sms_agree'),
            'email_agree' => $request->boolean('email_agree'),
            'ad_agree' => $request->boolean('agree_ad'),
            'zipcode' => $validated['zipcode'] ?? null,
            'address' => $validated['address'] ?? null,
            'address_detail' => $validated['address_detail'] ?? null,
            'is_active' => true,
            // 온라인 회원가입은 완료 즉시 인터넷회원 권한 자동 부여(관리자 승인 불필요)
            'approval_status' => 'approved',
            'approved_at' => now(),
        ]);

        // 가입 즉시 인터넷회원으로 자동 로그인 후 홈으로 이동
        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/')->with('success',
            '온라인 회원가입이 완료되었습니다. 인터넷회원으로 로그인되었습니다.');
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
