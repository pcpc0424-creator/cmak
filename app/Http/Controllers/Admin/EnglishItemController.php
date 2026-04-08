<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EnglishContent;
use App\Models\EnglishItem;
use Illuminate\Http\Request;

class EnglishItemController extends Controller
{
    public function update(Request $request, EnglishContent $englishContent, EnglishItem $item)
    {
        abort_unless($item->english_content_id === $englishContent->id, 404);

        $validated = $this->validateRequest($request);
        $validated['is_active'] = $request->has('is_active');

        $item->update($validated);

        return back()->with('success', '항목이 수정되었습니다.');
    }

    public function destroy(EnglishContent $englishContent, EnglishItem $item)
    {
        abort_unless($item->english_content_id === $englishContent->id, 404);
        $item->delete();

        return back()->with('success', '항목이 삭제되었습니다.');
    }

    public function reorder(Request $request, EnglishContent $englishContent)
    {
        $order = $request->input('order', []);
        foreach ($order as $position => $itemId) {
            EnglishItem::where('id', $itemId)
                ->where('english_content_id', $englishContent->id)
                ->update(['sort_order' => $position + 1]);
        }
        return response()->json(['ok' => true]);
    }

    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'type' => ['required', 'string', 'max:30'],
            'sort_order' => ['nullable', 'integer'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string', 'max:500'],
            'tag' => ['nullable', 'string', 'max:60'],
            'date_text' => ['nullable', 'string', 'max:60'],
            'link' => ['nullable', 'string', 'max:500'],
        ]);
    }
}
