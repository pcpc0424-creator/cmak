<?php

namespace App\Http\Controllers;

use App\Models\ReceptionEvent;
use App\Models\ReceptionSubmission;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    /** 온라인 접수 - 진행 중 행사 목록 */
    public function index()
    {
        $events = ReceptionEvent::active()
            ->orderByRaw("FIELD(status,'open','closed','done')")
            ->orderBy('sort_order')->latest()
            ->get();

        return view('reception.index', compact('events'));
    }

    /** 행사 상세 + 신청 폼 */
    public function show(string $slug)
    {
        $event = ReceptionEvent::active()->where('slug', $slug)->with('questions')->firstOrFail();

        return view('reception.show', compact('event'));
    }

    /** 신청 접수 */
    public function store(Request $request, string $slug)
    {
        $event = ReceptionEvent::active()->where('slug', $slug)->with('questions')->firstOrFail();

        if (!$event->isAcceptingNow()) {
            return back()->with('error', '현재 접수 가능한 기간이 아닙니다.');
        }

        // 문항별 동적 검증 규칙
        $rules = [];
        $attributes = [];
        foreach ($event->questions as $q) {
            $key = 'q_' . $q->id;
            $isMulti = $q->type === 'checkbox';
            $base = $q->is_required ? ['required'] : ['nullable'];
            if ($q->type === 'agreement') {
                $rules[$key] = $q->is_required ? ['accepted'] : ['nullable'];
            } elseif ($isMulti) {
                $rules[$key] = $base + ['array'];
            } else {
                $rules[$key] = $base + ['string', 'max:2000'];
            }
            $attributes[$key] = $q->label;
        }

        $validated = $request->validate($rules, [], $attributes);

        // 답변 정리 + 대표 성명/연락처 추출
        $answers = [];
        $name = $phone = $email = null;
        foreach ($event->questions as $q) {
            $key = 'q_' . $q->id;
            $val = $request->input($key);
            if ($q->type === 'agreement') {
                $val = $request->boolean($key) ? '동의' : '';
            }
            $answers[$q->id] = $val;

            $label = $q->label;
            if ($name === null && preg_match('/성명|이름/u', $label) && is_string($val)) {
                $name = $val;
            }
            if ($phone === null && preg_match('/휴대|전화|연락/u', $label) && is_string($val)) {
                $phone = $val;
            }
            if ($email === null && preg_match('/이메일|메일|email/iu', $label) && is_string($val)) {
                $email = $val;
            }
        }

        ReceptionSubmission::create([
            'reception_event_id' => $event->id,
            'user_id' => auth()->id(),
            'answers' => $answers,
            'applicant_name' => $name,
            'applicant_phone' => $phone,
            'applicant_email' => $email,
            'ip' => $request->ip(),
            'submitted_at' => now(),
        ]);

        return redirect('/cmak/reception/' . $event->slug)
            ->with('success', '신청이 정상적으로 접수되었습니다. 감사합니다.');
    }
}
