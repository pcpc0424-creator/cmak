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
            'popup_type' => ['nullable', 'string'],
            'position_x' => ['nullable', 'integer'],
            'position_y' => ['nullable', 'integer'],
            'width' => ['nullable', 'integer'],
            'height' => ['nullable', 'integer'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'is_active' => ['boolean'],
        ]);

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
            'popup_type' => ['nullable', 'string'],
            'position_x' => ['nullable', 'integer'],
            'position_y' => ['nullable', 'integer'],
            'width' => ['nullable', 'integer'],
            'height' => ['nullable', 'integer'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'is_active' => ['boolean'],
        ]);

        $popup->update($validated);

        return redirect($this->basePath . '/admin/popups')
            ->with('success', '팝업이 수정되었습니다.');
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
