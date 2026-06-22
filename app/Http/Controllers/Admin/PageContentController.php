<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function index()
    {
        $pages = PageContent::ofMenu('협회업무')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.page-contents.index', compact('pages'));
    }

    public function edit(PageContent $pageContent)
    {
        return view('admin.page-contents.edit', ['page' => $pageContent]);
    }

    public function update(Request $request, PageContent $pageContent)
    {
        $validated = $request->validate([
            'page_title'    => ['required', 'string', 'max:255'],
            'browser_title' => ['nullable', 'string', 'max:255'],
            'category'      => ['nullable', 'string', 'max:255'],
            'category_link' => ['nullable', 'string', 'max:255'],
            'sort_order'    => ['nullable', 'integer', 'min:0'],
            'content'       => ['nullable', 'string'],
            'is_published'  => ['nullable'],
        ]);

        $pageContent->update([
            'page_title'    => $validated['page_title'],
            'browser_title' => $validated['browser_title'] ?: null,
            'category'      => $validated['category'] ?: null,
            'category_link' => $validated['category_link'] ?: null,
            'sort_order'    => $validated['sort_order'] ?? 0,
            'content'       => $validated['content'] ?? '',
            'is_published'  => $request->has('is_published'),
        ]);

        return redirect()->route('admin.page-contents.index')
            ->with('success', "'{$pageContent->page_title}' 페이지가 저장되었습니다.");
    }
}
