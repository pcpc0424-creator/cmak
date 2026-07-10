<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReceptionEvent;
use App\Models\ReceptionQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReceptionEventController extends Controller
{
    public function index()
    {
        $events = ReceptionEvent::withCount('submissions')
            ->orderBy('sort_order')->latest()->paginate(20);

        return view('admin.reception.index', compact('events'));
    }

    public function create()
    {
        $event = new ReceptionEvent(['status' => 'open', 'is_active' => true]);
        return view('admin.reception.create', compact('event'));
    }

    public function store(Request $request)
    {
        $data = $this->validateEvent($request);
        $data['slug'] = $this->uniqueSlug($request->input('title'));
        $data['is_active'] = $request->boolean('is_active');

        $event = ReceptionEvent::create($data);
        $this->syncQuestions($event, $request->input('questions', []));

        return redirect(url('/admin/reception/' . $event->id . '/edit'))
            ->with('success', '행사가 등록되었습니다. 문항을 확인하세요.');
    }

    public function edit(ReceptionEvent $reception)
    {
        $reception->load('questions');
        return view('admin.reception.edit', ['event' => $reception]);
    }

    public function update(Request $request, ReceptionEvent $reception)
    {
        $data = $this->validateEvent($request);
        $data['is_active'] = $request->boolean('is_active');

        $reception->update($data);
        $this->syncQuestions($reception, $request->input('questions', []));

        return redirect(url('/admin/reception/' . $reception->id . '/edit'))
            ->with('success', '행사/문항이 저장되었습니다.');
    }

    public function destroy(ReceptionEvent $reception)
    {
        $reception->delete();

        return redirect(url('/admin/reception'))->with('success', '행사가 삭제되었습니다.');
    }

    /** 신청 데이터 목록 */
    public function submissions(ReceptionEvent $reception)
    {
        $reception->load('questions');
        $submissions = $reception->submissions()->latest('submitted_at')->paginate(30);

        return view('admin.reception.submissions', ['event' => $reception, 'submissions' => $submissions]);
    }

    /** 신청 데이터 엑셀(CSV, UTF-8 BOM) 다운로드 */
    public function export(ReceptionEvent $reception)
    {
        $reception->load('questions');
        $questions = $reception->questions;
        $rows = $reception->submissions()->orderBy('submitted_at')->get();

        $filename = 'reception_' . $reception->slug . '_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->stream(function () use ($questions, $rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");

            $head = ['No', '제출일시'];
            foreach ($questions as $q) {
                $head[] = $q->label;
            }
            fputcsv($out, $head);

            foreach ($rows as $i => $sub) {
                $ans = $sub->answers ?? [];
                $line = [$i + 1, optional($sub->submitted_at)->format('Y-m-d H:i')];
                foreach ($questions as $q) {
                    $v = $ans[$q->id] ?? '';
                    if (is_array($v)) {
                        $v = implode(', ', $v);
                    }
                    $line[] = $v;
                }
                fputcsv($out, $line);
            }
            fclose($out);
        }, 200, $headers);
    }

    // ── helpers ─────────────────────────────────────────

    protected function validateEvent(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_start' => ['nullable', 'date'],
            'event_end' => ['nullable', 'date'],
            'reg_start' => ['nullable', 'date'],
            'reg_end' => ['nullable', 'date'],
            'fee_info' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:open,closed,done'],
            'capacity' => ['nullable', 'integer', 'min:0'],
            'sort_order' => ['nullable', 'integer'],
        ]);
    }

    protected function uniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        if ($base === '') {
            $base = 'event';
        }
        $slug = $base;
        $n = 1;
        while (ReceptionEvent::where('slug', $slug)->exists()) {
            $slug = $base . '-' . (++$n);
        }
        return $slug;
    }

    /**
     * 폼에서 넘어온 questions 배열로 문항을 동기화(추가/수정/삭제).
     * questions[][id|label|type|options|is_required]
     */
    protected function syncQuestions(ReceptionEvent $event, array $questions): void
    {
        $keepIds = [];
        $order = 0;
        foreach ($questions as $q) {
            $label = trim($q['label'] ?? '');
            if ($label === '') {
                continue; // 라벨 없는 행 무시
            }
            $type = in_array($q['type'] ?? 'text', array_keys(ReceptionQuestion::TYPES), true) ? $q['type'] : 'text';

            $options = null;
            if (in_array($type, ['radio', 'checkbox', 'select'], true) && !empty($q['options'])) {
                $options = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $q['options']))));
            }

            $attrs = [
                'label' => $label,
                'type' => $type,
                'options' => $options,
                'is_required' => !empty($q['is_required']),
                'sort_order' => $order++,
            ];

            if (!empty($q['id']) && $existing = $event->questions()->find($q['id'])) {
                $existing->update($attrs);
                $keepIds[] = $existing->id;
            } else {
                $new = $event->questions()->create($attrs);
                $keepIds[] = $new->id;
            }
        }

        // 폼에서 빠진 기존 문항 삭제
        $event->questions()->whereNotIn('id', $keepIds ?: [0])->delete();
    }
}
