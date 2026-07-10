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
        $this->applyFilters($query, $request);

        $memberCompanies = $query->orderBy('company_name')->paginate(20)->withQueryString();

        $counts = [
            'active' => MemberCompany::where('is_active', true)->count(),
            'inactive' => MemberCompany::where('is_active', false)->count(),
            'all' => MemberCompany::count(),
        ];
        $status = $request->input('status', 'active');

        return view('admin.member-companies.index', compact('memberCompanies', 'counts', 'status'));
    }

    /** 목록/엑셀 공통 필터: 검색(회사명)·구분(용역/시공)·상태(노출/비노출/전체) */
    protected function applyFilters($query, Request $request): void
    {
        if ($request->filled('search')) {
            $query->where('company_name', 'like', '%' . $request->input('search') . '%');
        }
        if ($request->filled('company_type')) {
            $query->where('company_type', $request->input('company_type'));
        }
        if ($request->filled('region')) {
            $query->where('region', $request->input('region'));
        }
        // 상태 기본값 = active(회비납부·CM사소개 노출 = 현행 회원사, 약 181개). 전체(815)는 status=all
        $status = $request->input('status', 'active');
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }
    }

    /** 회원사 현황 CSV 다운로드 (엑셀 호환, UTF-8 BOM) */
    public function export(Request $request)
    {
        $query = MemberCompany::query();
        $this->applyFilters($query, $request);
        $companies = $query->orderBy('company_name')->get();

        $filename = 'member_companies_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $columns = ['No', '회사명', '구분', '지역', '대표자', '전화번호', '팩스', '주소', '홈페이지', '인증', 'CM사소개노출(회비납부)'];

        return response()->stream(function () use ($companies, $columns) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // 엑셀 한글 깨짐 방지 BOM
            fputcsv($out, $columns);
            foreach ($companies as $i => $c) {
                fputcsv($out, [
                    $i + 1,
                    $c->company_name,
                    $c->company_type,
                    $c->region,
                    $c->representative,
                    $c->phone,
                    $c->fax,
                    $c->address,
                    $c->website,
                    $c->is_verified ? '인증' : '미인증',
                    $c->is_active ? '노출' : '비노출',
                ]);
            }
            fclose($out);
        }, 200, $headers);
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
            'company_type' => ['nullable', 'string', 'max:100'],
            'representative' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:50'],
            'fax' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:500'],
            'website' => ['nullable', 'url', 'max:255'],
            'is_verified' => ['boolean'],
            'is_active' => ['boolean'],
            'is_integrated' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
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
            'company_type' => ['nullable', 'string', 'max:100'],
            'representative' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:50'],
            'fax' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:500'],
            'website' => ['nullable', 'url', 'max:255'],
            'is_verified' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'is_integrated' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_verified'] = $request->boolean('is_verified');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_integrated'] = $request->boolean('is_integrated');

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
