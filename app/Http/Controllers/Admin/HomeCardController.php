<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeCard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HomeCardController extends Controller
{
    public function index()
    {
        $cards = HomeCard::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.home-cards.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.home-cards.create', ['icons' => HomeCard::ICONS]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storeImage($request);
        }
        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active');
        if (!isset($validated['sort_order'])) {
            $validated['sort_order'] = (HomeCard::max('sort_order') ?? 0) + 1;
        }

        HomeCard::create($validated);

        return redirect(url('/admin/home-cards'))->with('success', '바로가기 카드가 등록되었습니다.');
    }

    public function edit(HomeCard $homeCard)
    {
        return view('admin.home-cards.edit', ['card' => $homeCard, 'icons' => HomeCard::ICONS]);
    }

    public function update(Request $request, HomeCard $homeCard)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('image')) {
            $old = $homeCard->image_path;
            $validated['image_path'] = $this->storeImage($request);
            if ($old && file_exists(public_path($old))) {
                @unlink(public_path($old));
            }
        }
        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active');

        $homeCard->update($validated);

        return redirect(url('/admin/home-cards'))->with('success', '바로가기 카드가 수정되었습니다.');
    }

    public function destroy(HomeCard $homeCard)
    {
        if ($homeCard->image_path && file_exists(public_path($homeCard->image_path))) {
            @unlink(public_path($homeCard->image_path));
        }
        $homeCard->delete();

        return redirect(url('/admin/home-cards'))->with('success', '바로가기 카드가 삭제되었습니다.');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'link_url' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', Rule::in(array_keys(HomeCard::ICONS))],
            'image' => ['nullable', 'image', 'max:5120'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);
    }

    protected function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '', $file->getClientOriginalName());
        $dir = public_path('images/home-cards');
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        $file->move($dir, $filename);

        return 'images/home-cards/' . $filename;
    }
}
