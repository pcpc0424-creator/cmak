<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopPopupItem;
use Illuminate\Http\Request;

class TopPopupItemController extends Controller
{
    public function index()
    {
        $items = TopPopupItem::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.top-popup-items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.top-popup-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'link_url' => ['nullable', 'string', 'max:500'],
            'link_target' => ['nullable', 'in:_self,_blank'],
            'image' => ['nullable', 'image', 'max:5120'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storeImage($request);
        }
        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active');
        if (!isset($validated['sort_order'])) {
            $validated['sort_order'] = (TopPopupItem::max('sort_order') ?? 0) + 1;
        }

        TopPopupItem::create($validated);

        return redirect(url('/admin/top-popup-items'))
            ->with('success', '상단 POPUP 버튼이 등록되었습니다.');
    }

    public function edit(TopPopupItem $topPopupItem)
    {
        return view('admin.top-popup-items.edit', compact('topPopupItem'));
    }

    public function update(Request $request, TopPopupItem $topPopupItem)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'link_url' => ['nullable', 'string', 'max:500'],
            'link_target' => ['nullable', 'in:_self,_blank'],
            'image' => ['nullable', 'image', 'max:5120'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $old = $topPopupItem->image_path;
            $validated['image_path'] = $this->storeImage($request);
            if ($old && file_exists(public_path($old))) {
                @unlink(public_path($old));
            }
        } elseif ($request->boolean('remove_image')) {
            // 새 이미지 업로드 없이 기존 이미지만 삭제
            if ($topPopupItem->image_path && file_exists(public_path($topPopupItem->image_path))) {
                @unlink(public_path($topPopupItem->image_path));
            }
            $validated['image_path'] = null;
        }
        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active');

        $topPopupItem->update($validated);

        return redirect(url('/admin/top-popup-items'))
            ->with('success', '상단 POPUP 버튼이 수정되었습니다.');
    }

    public function destroy(TopPopupItem $topPopupItem)
    {
        if ($topPopupItem->image_path && file_exists(public_path($topPopupItem->image_path))) {
            @unlink(public_path($topPopupItem->image_path));
        }
        $topPopupItem->delete();

        return redirect(url('/admin/top-popup-items'))
            ->with('success', '상단 POPUP 버튼이 삭제되었습니다.');
    }

    protected function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '', $file->getClientOriginalName());
        $dir = public_path('images/top-popup');
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        $file->move($dir, $filename);

        return 'images/top-popup/' . $filename;
    }
}
