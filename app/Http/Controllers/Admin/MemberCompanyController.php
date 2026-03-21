<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberCompany;
use Illuminate\Http\Request;

class MemberCompanyController extends Controller
{
    protected string $basePath = '';

    public function index(Request $request)
    {
        $query = MemberCompany::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('company_name', 'like', "%{$search}%");
        }

        if ($request->filled('region')) {
            $query->where('region', $request->input('region'));
        }

        $memberCompanies = $query->latest()->paginate(20)->withQueryString();

        return view('admin.member-companies.index', compact('memberCompanies'));
    }

    public function create()
    {
        return view('admin.member-companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'region' => ['nullable', 'string', 'max:100'],
            'representative' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'website' => ['nullable', 'url', 'max:255'],
            'is_verified' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        MemberCompany::create($validated);

        return redirect($this->basePath . '/admin/member-companies')
            ->with('success', '회원사가 등록되었습니다.');
    }

    public function show(MemberCompany $memberCompany)
    {
        return view('admin.member-companies.show', compact('memberCompany'));
    }

    public function edit(MemberCompany $memberCompany)
    {
        return view('admin.member-companies.edit', compact('memberCompany'));
    }

    public function update(Request $request, MemberCompany $memberCompany)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'region' => ['nullable', 'string', 'max:100'],
            'representative' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'website' => ['nullable', 'url', 'max:255'],
            'is_verified' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        $memberCompany->update($validated);

        return redirect($this->basePath . '/admin/member-companies')
            ->with('success', '회원사 정보가 수정되었습니다.');
    }

    public function destroy(MemberCompany $memberCompany)
    {
        $memberCompany->delete();

        return redirect($this->basePath . '/admin/member-companies')
            ->with('success', '회원사가 삭제되었습니다.');
    }

    public function toggleVerify(MemberCompany $memberCompany)
    {
        $memberCompany->update([
            'is_verified' => !$memberCompany->is_verified,
        ]);

        return back()->with('success', '인증 상태가 변경되었습니다.');
    }

    public function toggleActive(MemberCompany $memberCompany)
    {
        $memberCompany->update([
            'is_active' => !$memberCompany->is_active,
        ]);

        return back()->with('success', '활성화 상태가 변경되었습니다.');
    }
}
