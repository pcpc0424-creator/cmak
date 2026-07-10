<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'highlight' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:8192'],
            'is_active' => ['boolean'],
            'show_eyebrow' => ['boolean'],
            'title_bold' => ['boolean'],
            'highlight_bold' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['image_path'] = $this->storeImage($request);
        unset($validated['image']);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['show_eyebrow'] = $request->boolean('show_eyebrow');
        $validated['title_bold'] = $request->boolean('title_bold');
        $validated['highlight_bold'] = $request->boolean('highlight_bold');
        if (!isset($validated['sort_order'])) {
            $validated['sort_order'] = (HeroSlide::max('sort_order') ?? 0) + 1;
        }

        HeroSlide::create($validated);

        return redirect(url('/admin/hero-slides'))
            ->with('success', '히어로 슬라이드가 등록되었습니다.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'highlight' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:8192'],
            'is_active' => ['boolean'],
            'show_eyebrow' => ['boolean'],
            'title_bold' => ['boolean'],
            'highlight_bold' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $old = $heroSlide->image_path;
            $validated['image_path'] = $this->storeImage($request);
            if ($old && file_exists(public_path($old))) {
                @unlink(public_path($old));
            }
        }
        unset($validated['image']);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['show_eyebrow'] = $request->boolean('show_eyebrow');
        $validated['title_bold'] = $request->boolean('title_bold');
        $validated['highlight_bold'] = $request->boolean('highlight_bold');

        $heroSlide->update($validated);

        return redirect(url('/admin/hero-slides'))
            ->with('success', '히어로 슬라이드가 수정되었습니다.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        if ($heroSlide->image_path && file_exists(public_path($heroSlide->image_path))) {
            @unlink(public_path($heroSlide->image_path));
        }

        $heroSlide->delete();

        return redirect(url('/admin/hero-slides'))
            ->with('success', '히어로 슬라이드가 삭제되었습니다.');
    }

    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'integer', 'exists:hero_slides,id'],
            'items.*.sort_order' => ['required', 'integer'],
        ]);

        foreach ($validated['items'] as $item) {
            HeroSlide::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => '순서가 변경되었습니다.']);
    }

    /**
     * 배너 컨트롤러와 동일하게 public/images/banners/hero 로 저장하고 상대경로 반환
     */
    protected function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '', $file->getClientOriginalName());
        $dir = public_path('images/banners/hero');
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        $file->move($dir, $filename);

        return 'images/banners/hero/' . $filename;
    }
}
