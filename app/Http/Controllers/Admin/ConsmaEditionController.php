<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsmaEdition;
use Illuminate\Http\Request;

class ConsmaEditionController extends Controller
{
    public function index()
    {
        $editions = ConsmaEdition::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.consma-editions.index', compact('editions'));
    }

    public function create()
    {
        return view('admin.consma-editions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => ['required', 'string', 'max:10', 'unique:consma_editions,year'],
            'main_text' => ['nullable', 'string', 'max:255'],
            'sub_text' => ['nullable', 'string', 'max:255'],
            'detail_url' => ['nullable', 'string', 'max:500'],
            'detail_content' => ['nullable', 'string'],
            'poster' => ['required', 'image', 'max:61440'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        [$thumb, $full] = $this->storePoster($request, $validated['year']);
        $validated['thumb_path'] = $thumb;
        $validated['full_path'] = $full;
        unset($validated['poster']);

        $validated['is_active'] = $request->boolean('is_active');
        if (!isset($validated['sort_order'])) {
            $validated['sort_order'] = (ConsmaEdition::max('sort_order') ?? 0) + 1;
        }

        ConsmaEdition::create($validated);

        return redirect(url('/admin/consma-editions'))->with('success', 'ConsMa 포스터가 등록되었습니다.');
    }

    public function edit(ConsmaEdition $consmaEdition)
    {
        return view('admin.consma-editions.edit', compact('consmaEdition'));
    }

    public function update(Request $request, ConsmaEdition $consmaEdition)
    {
        $validated = $request->validate([
            'year' => ['required', 'string', 'max:10', 'unique:consma_editions,year,' . $consmaEdition->id],
            'main_text' => ['nullable', 'string', 'max:255'],
            'sub_text' => ['nullable', 'string', 'max:255'],
            'detail_url' => ['nullable', 'string', 'max:500'],
            'detail_content' => ['nullable', 'string'],
            'poster' => ['nullable', 'image', 'max:61440'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('poster')) {
            [$thumb, $full] = $this->storePoster($request, $validated['year']);
            $validated['thumb_path'] = $thumb;
            $validated['full_path'] = $full;
        }
        unset($validated['poster']);

        $validated['is_active'] = $request->boolean('is_active');

        $consmaEdition->update($validated);

        return redirect(url('/admin/consma-editions'))->with('success', 'ConsMa 포스터가 수정되었습니다.');
    }

    public function destroy(ConsmaEdition $consmaEdition)
    {
        $consmaEdition->delete();

        return redirect(url('/admin/consma-editions'))->with('success', 'ConsMa 포스터가 삭제되었습니다.');
    }

    /**
     * 업로드 포스터를 웹용 썸네일(가로600)·상세(가로1400)로 생성.
     * GD 미탑재 환경이라 ImageMagick(convert)로 처리하고, 실패 시 원본을 그대로 사용.
     *
     * @return array{0:string,1:string} [thumb_path, full_path]
     */
    protected function storePoster(Request $request, string $year): array
    {
        $file = $request->file('poster');
        $dir = public_path('images/business/consma/posters');
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $stamp = time();
        $orig = $dir . "/orig_{$year}_{$stamp}." . $file->getClientOriginalExtension();
        $file->move($dir, basename($orig));

        $thumbRel = "images/business/consma/posters/thumb_{$year}_{$stamp}.jpg";
        $fullRel = "images/business/consma/posters/full_{$year}_{$stamp}.jpg";
        $thumbAbs = public_path($thumbRel);
        $fullAbs = public_path($fullRel);

        $convert = trim((string) @shell_exec('which convert'));
        if ($convert !== '') {
            @shell_exec(sprintf('%s %s -auto-orient -resize %s -strip -quality 82 %s 2>/dev/null',
                escapeshellarg($convert), escapeshellarg($orig), escapeshellarg('600x>'), escapeshellarg($thumbAbs)));
            @shell_exec(sprintf('%s %s -auto-orient -resize %s -strip -quality 85 %s 2>/dev/null',
                escapeshellarg($convert), escapeshellarg($orig), escapeshellarg('1400x>'), escapeshellarg($fullAbs)));
        }

        // convert 실패 시 원본을 양쪽에 폴백
        if (!file_exists($thumbAbs) || !file_exists($fullAbs)) {
            $origRel = 'images/business/consma/posters/' . basename($orig);
            @chmod($orig, 0644);
            return [
                file_exists($thumbAbs) ? $thumbRel : $origRel,
                file_exists($fullAbs) ? $fullRel : $origRel,
            ];
        }

        @unlink($orig);
        @chmod($thumbAbs, 0644);
        @chmod($fullAbs, 0644);

        return [$thumbRel, $fullRel];
    }
}
