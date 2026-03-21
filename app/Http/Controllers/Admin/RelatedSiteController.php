<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RelatedSite;
use Illuminate\Http\Request;

class RelatedSiteController extends Controller
{
    protected string $basePath = '';

    public function index(Request $request)
    {
        $query = RelatedSite::query();

        if ($request->filled('site_type')) {
            $query->where('site_type', $request->input('site_type'));
        }

        $sites = $query->orderBy('sort_order')->paginate(15)->withQueryString();

        return view('admin.related-sites.index', compact('sites'));
    }

    public function create()
    {
        return view('admin.related-sites.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_url' => ['required', 'url', 'max:500'],
            'site_type' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/sites'), $filename);
            $validated['logo_path'] = 'images/sites/' . $filename;
        }

        unset($validated['logo']);

        RelatedSite::create($validated);

        return redirect($this->basePath . '/admin/related-sites')
            ->with('success', '관련 사이트가 등록되었습니다.');
    }

    public function show(RelatedSite $relatedSite)
    {
        return view('admin.related-sites.show', compact('relatedSite'));
    }

    public function edit(RelatedSite $relatedSite)
    {
        return view('admin.related-sites.edit', compact('relatedSite'));
    }

    public function update(Request $request, RelatedSite $relatedSite)
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_url' => ['required', 'url', 'max:500'],
            'site_type' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/sites'), $filename);
            $validated['logo_path'] = 'images/sites/' . $filename;

            if ($relatedSite->logo_path && file_exists(public_path($relatedSite->logo_path))) {
                unlink(public_path($relatedSite->logo_path));
            }
        }

        unset($validated['logo']);
        $relatedSite->update($validated);

        return redirect($this->basePath . '/admin/related-sites')
            ->with('success', '관련 사이트가 수정되었습니다.');
    }

    public function destroy(RelatedSite $relatedSite)
    {
        if ($relatedSite->logo_path && file_exists(public_path($relatedSite->logo_path))) {
            unlink(public_path($relatedSite->logo_path));
        }

        $relatedSite->delete();

        return redirect($this->basePath . '/admin/related-sites')
            ->with('success', '관련 사이트가 삭제되었습니다.');
    }
}
