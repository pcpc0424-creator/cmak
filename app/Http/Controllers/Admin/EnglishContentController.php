<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EnglishContent;
use Illuminate\Http\Request;

class EnglishContentController extends Controller
{
    protected string $basePath = '';

    public function index(Request $request)
    {
        $query = EnglishContent::query();

        if ($request->filled('section')) {
            $query->where('section', $request->input('section'));
        }

        $contents = $query->latest()->paginate(15)->withQueryString();

        return view('admin.english-contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.english-contents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'section' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'is_active' => ['boolean'],
        ]);

        EnglishContent::create($validated);

        return redirect($this->basePath . '/admin/english-contents')
            ->with('success', '영문 콘텐츠가 등록되었습니다.');
    }

    public function show(EnglishContent $englishContent)
    {
        return view('admin.english-contents.show', compact('englishContent'));
    }

    public function edit(EnglishContent $englishContent)
    {
        return view('admin.english-contents.edit', compact('englishContent'));
    }

    public function update(Request $request, EnglishContent $englishContent)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'section' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'is_active' => ['boolean'],
        ]);

        $englishContent->update($validated);

        return redirect($this->basePath . '/admin/english-contents')
            ->with('success', '영문 콘텐츠가 수정되었습니다.');
    }

    public function destroy(EnglishContent $englishContent)
    {
        $englishContent->delete();

        return redirect($this->basePath . '/admin/english-contents')
            ->with('success', '영문 콘텐츠가 삭제되었습니다.');
    }
}
