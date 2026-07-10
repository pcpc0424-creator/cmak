<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    protected string $basePath = '';

    public function index(Request $request)
    {
        // 관리자(직원)계정 전용 — 온라인 개인회원(role=member)은 '회원관리'에서 별도 관리
        $query = User::where('role', '!=', 'member');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        $accounts = $query->latest()->paginate(15)->withQueryString();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'string', 'in:admin,editor,user'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::in(array_keys(User::PERMISSIONS))],
            'department' => ['nullable', 'string', 'max:100'],
            'position' => ['nullable', 'string', 'max:100'],
            'is_active' => ['boolean'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        // 권한은 editor에게만 의미 있음 (admin=전체 허용, user=관리자 접근 불가)
        $validated['permissions'] = $validated['role'] === 'editor'
            ? ($request->input('permissions', []))
            : null;

        User::create($validated);

        return redirect($this->basePath . '/admin/accounts')
            ->with('success', '계정이 생성되었습니다.');
    }

    public function show(User $account)
    {
        return view('admin.accounts.show', compact('account'));
    }

    public function edit(User $account)
    {
        abort_if($account->role === 'member', 404); // 온라인회원은 회원관리에서 처리
        return view('admin.accounts.edit', compact('account'));
    }

    public function update(Request $request, User $account)
    {
        abort_if($account->role === 'member', 404);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $account->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => ['required', 'string', 'in:admin,editor,user'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::in(array_keys(User::PERMISSIONS))],
            'department' => ['nullable', 'string', 'max:100'],
            'position' => ['nullable', 'string', 'max:100'],
            'is_active' => ['boolean'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // 권한은 editor에게만 의미 있음
        $validated['permissions'] = $validated['role'] === 'editor'
            ? ($request->input('permissions', []))
            : null;

        $account->update($validated);

        return redirect($this->basePath . '/admin/accounts')
            ->with('success', '계정이 수정되었습니다.');
    }

    public function destroy(User $account)
    {
        abort_if($account->role === 'member', 404);
        if ($account->id === auth()->id()) {
            return back()->with('error', '자신의 계정은 삭제할 수 없습니다.');
        }

        $account->delete();

        return redirect($this->basePath . '/admin/accounts')
            ->with('success', '계정이 삭제되었습니다.');
    }
}
