<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeraldIssue;
use Illuminate\Http\Request;

class HeraldIssueController extends Controller
{
    public function index()
    {
        $issues = HeraldIssue::orderByDesc('issue_date')->orderByDesc('sort_order')->orderByDesc('id')->paginate(20);

        return view('admin.herald-issues.index', compact('issues'));
    }

    public function create()
    {
        return view('admin.herald-issues.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request, true);

        $validated['cover_image'] = $request->hasFile('cover') ? $this->storeFile($request, 'cover', 'images/herald', ['image']) : null;
        $validated['webzine_url'] = $this->resolveWebzine($request);
        unset($validated['cover'], $validated['webzine_file']);
        $validated['is_published'] = $request->boolean('is_published');
        if (!isset($validated['sort_order'])) {
            $validated['sort_order'] = (HeraldIssue::max('sort_order') ?? 0) + 1;
        }

        HeraldIssue::create($validated);

        return redirect(url('/admin/herald-issues'))->with('success', 'CM Herald 호가 등록되었습니다.');
    }

    public function edit(HeraldIssue $heraldIssue)
    {
        return view('admin.herald-issues.edit', compact('heraldIssue'));
    }

    public function update(Request $request, HeraldIssue $heraldIssue)
    {
        $validated = $this->validateData($request, false);

        if ($request->hasFile('cover')) {
            $old = $heraldIssue->cover_image;
            $validated['cover_image'] = $this->storeFile($request, 'cover', 'images/herald', ['image']);
            if ($old && file_exists(public_path($old))) {
                @unlink(public_path($old));
            }
        }

        $webzine = $this->resolveWebzine($request);
        if ($webzine !== null) {
            $validated['webzine_url'] = $webzine;
        }

        unset($validated['cover'], $validated['webzine_file']);
        $validated['is_published'] = $request->boolean('is_published');

        $heraldIssue->update($validated);

        return redirect(url('/admin/herald-issues'))->with('success', 'CM Herald 호가 수정되었습니다.');
    }

    public function destroy(HeraldIssue $heraldIssue)
    {
        if ($heraldIssue->cover_image && file_exists(public_path($heraldIssue->cover_image))) {
            @unlink(public_path($heraldIssue->cover_image));
        }
        $heraldIssue->delete();

        return redirect(url('/admin/herald-issues'))->with('success', 'CM Herald 호가 삭제되었습니다.');
    }

    protected function validateData(Request $request, bool $creating): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issue_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:1000'],
            'cover' => [$creating ? 'nullable' : 'nullable', 'image', 'max:5120'],
            'webzine_url' => ['nullable', 'string', 'max:1000'],
            'webzine_file' => ['nullable', 'file', 'mimes:pdf', 'max:51200'],
            'is_published' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);
    }

    /**
     * 웹진보기 대상 결정: PDF 업로드가 있으면 그 경로, 없으면 입력한 URL.
     */
    protected function resolveWebzine(Request $request): ?string
    {
        if ($request->hasFile('webzine_file')) {
            return $this->storeFile($request, 'webzine_file', 'herald/webzine', ['pdf']);
        }
        $url = $request->input('webzine_url');
        return $url !== null && $url !== '' ? $url : null;
    }

    protected function storeFile(Request $request, string $key, string $relDir, array $kinds): string
    {
        $file = $request->file($key);
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '', $file->getClientOriginalName());
        $dir = public_path($relDir);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        $file->move($dir, $filename);

        return $relDir . '/' . $filename;
    }
}
