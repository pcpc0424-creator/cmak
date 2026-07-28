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
        $this->normalizeCoordinateInput($request);

        $validated = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storeImage($request);
        }
        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated = $this->applyDimensionDefaults($validated);

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
        $this->normalizeCoordinateInput($request);

        $validated = $request->validate($this->rules());

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
        $validated = $this->applyDimensionDefaults($validated);

        $popup->update($validated);

        return redirect($this->basePath . '/admin/popups')
            ->with('success', '팝업이 수정되었습니다.');
    }

    /**
     * 등록/수정 공통 검증 규칙.
     * 좌표(X/Y)와 크기(W/H)는 비워둘 수 있으며(nullable), 값이 있으면 정수여야 합니다.
     * 좌표는 0 이상, 크기는 1 이상만 허용합니다.
     */
    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'link_url' => ['nullable', 'string', 'max:500'],
            'popup_type' => ['nullable', 'string'],
            'position_x' => ['nullable', 'integer', 'min:0'],
            'position_y' => ['nullable', 'integer', 'min:0'],
            'width' => ['nullable', 'integer', 'min:1'],
            'height' => ['nullable', 'integer', 'min:1'],
            'sort_order' => ['nullable', 'integer'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * 검증 전 좌표/크기 입력값을 정리합니다.
     * 공백만 있는 문자열("   ")은 null로 통일하여, 비어있는 값이
     * integer 검증에 걸려 오류가 나는 것을 방지합니다. (null/""는 이미 null 취급)
     */
    protected function normalizeCoordinateInput(Request $request): void
    {
        foreach (['position_x', 'position_y', 'width', 'height'] as $key) {
            $value = $request->input($key);
            if ($value === null || (is_string($value) && trim($value) === '')) {
                $request->merge([$key => null]);
            }
        }
    }

    /**
     * 저장 직전, 비어있는 좌표/크기에 기본값을 적용합니다.
     * null / undefined(키 없음) / "" / 공백 문자열 모두 기본값으로 대체하고,
     * 값이 있으면 사용자가 입력한 값을 정수로 그대로 사용합니다.
     * (컬럼이 NOT NULL 이라 null 저장 시 SQL 오류가 발생하므로 여기서 보정)
     */
    protected function applyDimensionDefaults(array $validated): array
    {
        $defaults = [
            'position_x' => Popup::DEFAULT_POSITION_X,
            'position_y' => Popup::DEFAULT_POSITION_Y,
            'width' => Popup::DEFAULT_WIDTH,
            'height' => Popup::DEFAULT_HEIGHT,
        ];

        foreach ($defaults as $key => $default) {
            $value = $validated[$key] ?? null;
            if (is_string($value)) {
                $value = trim($value);
            }
            $validated[$key] = ($value === null || $value === '') ? $default : (int) $value;
        }

        return $validated;
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
