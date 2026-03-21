<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected string $basePath = '';

    public function index(Request $request)
    {
        $query = Banner::query();

        if ($request->filled('screen_type')) {
            $query->where('screen_type', $request->input('screen_type'));
        }

        $banners = $query->orderBy('sort_order')->paginate(15)->withQueryString();

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'screen_type' => ['required', 'string'],
            'link_url' => ['nullable', 'url', 'max:500'],
            'image' => ['required', 'image', 'max:5120'],
            'is_active' => ['boolean'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/banners'), $filename);
            $validated['image_path'] = 'images/banners/' . $filename;
        }

        unset($validated['image']);
        if (!isset($validated['sort_order'])) {
            $validated['sort_order'] = Banner::max('sort_order') + 1;
        }

        Banner::create($validated);

        return redirect($this->basePath . '/admin/banners')
            ->with('success', '배너가 등록되었습니다.');
    }

    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'screen_type' => ['required', 'string'],
            'link_url' => ['nullable', 'url', 'max:500'],
            'image' => ['nullable', 'image', 'max:5120'],
            'is_active' => ['boolean'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/banners'), $filename);
            $validated['image_path'] = 'images/banners/' . $filename;

            // Delete old image if exists
            if ($banner->image_path && file_exists(public_path($banner->image_path))) {
                unlink(public_path($banner->image_path));
            }
        }

        unset($validated['image']);
        $banner->update($validated);

        return redirect($this->basePath . '/admin/banners')
            ->with('success', '배너가 수정되었습니다.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image_path && file_exists(public_path($banner->image_path))) {
            unlink(public_path($banner->image_path));
        }

        $banner->delete();

        return redirect($this->basePath . '/admin/banners')
            ->with('success', '배너가 삭제되었습니다.');
    }

    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'integer', 'exists:banners,id'],
            'items.*.sort_order' => ['required', 'integer'],
        ]);

        foreach ($validated['items'] as $item) {
            Banner::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => '순서가 변경되었습니다.',
        ]);
    }
}
