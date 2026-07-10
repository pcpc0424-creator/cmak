<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Http\Request;

class PopupController extends Controller
{
    protected string $basePath = '';

    public function index()
    {
        $popups = Popup::latest()->paginate(15);

        return view('admin.popups.index', compact('popups'));
    }

    public function create()
    {
        return view('admin.popups.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'link_url' => ['nullable', 'string', 'max:500'],
            'popup_type' => ['nullable', 'string'],
            'position_x' => ['nullable', 'integer'],
            'position_y' => ['nullable', 'integer'],
            'width' => ['nullable', 'integer'],
            'height' => ['nullable', 'integer'],
            'sort_order' => ['nullable', 'integer'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storeImage($request);
        }
        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active');

        Popup::create($validated);

        return redirect($this->basePath . '/admin/popups')
            ->with('success', '팝업이 등록되었습니다.');
    }

    public function show(Popup $popup)
    {
        return view('admin.popups.show', compact('popup'));
    }

    public function edit(Popup $popup)
    {
        return view('admin.popups.edit', compact('popup'));
    }

    public function update(Request $request, Popup $popup)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'link_url' => ['nullable', 'string', 'max:500'],
            'popup_type' => ['nullable', 'string'],
            'position_x' => ['nullable', 'integer'],
            'position_y' => ['nullable', 'integer'],
            'width' => ['nullable', 'integer'],
            'height' => ['nullable', 'integer'],
            'sort_order' => ['nullable', 'integer'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('image')) {
            $old = $popup->image_path;
            $validated['image_path'] = $this->storeImage($request);
            if ($old && file_exists(public_path($old))) {
                @unlink(public_path($old));
            }
        } elseif ($request->boolean('remove_image')) {
            if ($popup->image_path && file_exists(public_path($popup->image_path))) {
                @unlink(public_path($popup->image_path));
            }
            $validated['image_path'] = null;
        }
        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active');

        $popup->update($validated);

        return redirect($this->basePath . '/admin/popups')
            ->with('success', '팝업이 수정되었습니다.');
    }

    protected function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '', $file->getClientOriginalName());
        $dir = public_path('images/popups');
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        $file->move($dir, $filename);

        return 'images/popups/' . $filename;
    }

    public function destroy(Popup $popup)
    {
        $popup->delete();

        return redirect($this->basePath . '/admin/popups')
            ->with('success', '팝업이 삭제되었습니다.');
    }

    public function toggleActive(Popup $popup)
    {
        $popup->update([
            'is_active' => !$popup->is_active,
        ]);

        return back()->with('success', '팝업 활성화 상태가 변경되었습니다.');
    }

    public function preview(Popup $popup)
    {
        return view('admin.popups.preview', compact('popup'));
    }
}
