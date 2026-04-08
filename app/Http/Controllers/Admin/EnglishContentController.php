<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EnglishContent;
use Illuminate\Http\Request;

class EnglishContentController extends Controller
{
    public function index(Request $request)
    {
        $section = $request->input('section');

        $query = EnglishContent::query()->orderBy('section')->orderBy('sort_order');
        if ($section) {
            $query->where('section', $section);
        }

        $contents = $query->get()->groupBy('section');
        $sectionLabels = EnglishContent::sectionLabels();

        return view('admin.english-contents.index', compact('contents', 'sectionLabels', 'section'));
    }

    public function edit(EnglishContent $englishContent)
    {
        $sectionLabels = EnglishContent::sectionLabels();
        $englishContent->load('items');
        return view('admin.english-contents.edit', [
            'content' => $englishContent,
            'sectionLabels' => $sectionLabels,
            'items' => $englishContent->items,
        ]);
    }

    public function update(Request $request, EnglishContent $englishContent)
    {
        $validated = $this->validateRequest($request, $englishContent->id);
        $englishContent->update($validated);

        return redirect()->route('admin.english-contents.index')
            ->with('success', '영문 페이지가 수정되었습니다.');
    }

    public function destroy(EnglishContent $englishContent)
    {
        $englishContent->delete();

        return redirect()->route('admin.english-contents.index')
            ->with('success', '영문 페이지가 삭제되었습니다.');
    }

    protected function validateRequest(Request $request, $ignoreId = null): array
    {
        $slugRule = ['required', 'string', 'max:255'];
        if ($ignoreId) {
            $slugRule[] = 'unique:english_contents,slug,' . $ignoreId;
        } else {
            $slugRule[] = 'unique:english_contents,slug';
        }

        $validated = $request->validate([
            'slug' => $slugRule,
            'section' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'hero_image' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_published' => ['nullable'],
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}
