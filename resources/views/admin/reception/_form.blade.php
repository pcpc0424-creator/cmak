@php
    $dt = fn($v) => $v ? $v->format('Y-m-d\TH:i') : '';
    $initQuestions = $event->questions->map(fn($q) => [
        'id' => $q->id,
        'label' => $q->label,
        'type' => $q->type,
        'options' => implode("\n", $q->options ?? []),
        'required' => (bool) $q->is_required,
    ])->values();
@endphp

<div class="bg-white rounded-lg shadow p-6 space-y-5">
    <h2 class="text-lg font-bold text-gray-800">행사 정보</h2>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">행사명 <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title', $event->title) }}" required
               class="w-full rounded-md border-gray-300 shadow-sm text-sm">
        @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">행사 설명</label>
        <textarea name="description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm text-sm">{{ old('description', $event->description) }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">행사 시작일시</label>
            <input type="datetime-local" name="event_start" value="{{ old('event_start', $dt($event->event_start)) }}" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">행사 종료일시</label>
            <input type="datetime-local" name="event_end" value="{{ old('event_end', $dt($event->event_end)) }}" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">접수 시작일시</label>
            <input type="datetime-local" name="reg_start" value="{{ old('reg_start', $dt($event->reg_start)) }}" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">접수 마감일시</label>
            <input type="datetime-local" name="reg_end" value="{{ old('reg_end', $dt($event->reg_end)) }}" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">참가비</label>
            <input type="text" name="fee_info" value="{{ old('fee_info', $event->fee_info) }}" placeholder="예: 일반 5만원 / 회원 3만원"
                   class="w-full rounded-md border-gray-300 shadow-sm text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">상태</label>
            <select name="status" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                @foreach(\App\Models\ReceptionEvent::STATUSES as $k => $label)
                    <option value="{{ $k }}" {{ old('status', $event->status) === $k ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">정원 (미입력=제한없음)</label>
            <input type="number" name="capacity" value="{{ old('capacity', $event->capacity) }}" min="0"
                   class="w-full rounded-md border-gray-300 shadow-sm text-sm">
        </div>
    </div>

    <div class="flex items-center gap-6">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $event->is_active ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
            <span class="text-sm text-gray-700">노출(사용자 페이지 표시)</span>
        </label>
        <div class="flex items-center gap-2">
            <label class="text-sm text-gray-700">정렬순서</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $event->sort_order ?? 0) }}" min="0" class="w-20 rounded-md border-gray-300 shadow-sm text-sm text-center">
        </div>
    </div>
</div>

{{-- 문항 빌더 --}}
<div class="bg-white rounded-lg shadow p-6 space-y-4 mt-6"
     x-data="{
        questions: @js($initQuestions),
        add(type='text'){ this.questions.push({id:'',label:'',type:type,options:'',required:false}); },
        loadTemplate(){
            this.questions.push(
                {id:'',label:'개인정보 수집·이용 동의',type:'agreement',options:'',required:true},
                {id:'',label:'성명',type:'text',options:'',required:true},
                {id:'',label:'휴대전화번호',type:'text',options:'',required:true},
                {id:'',label:'이메일',type:'text',options:'',required:true},
                {id:'',label:'소속(업체/기관명)',type:'text',options:'',required:false},
                {id:'',label:'부서',type:'text',options:'',required:false},
                {id:'',label:'직책',type:'text',options:'',required:false}
            );
        },
        needsOptions(t){ return ['radio','checkbox','select'].includes(t); }
     }">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-bold text-gray-800">신청 문항</h2>
        <div class="flex gap-2">
            <button type="button" @click="loadTemplate()" class="px-3 py-1.5 bg-gray-100 text-gray-700 text-sm rounded hover:bg-gray-200">기본 문항 불러오기</button>
            <button type="button" @click="add()" class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">+ 문항 추가</button>
        </div>
    </div>

    <p class="text-xs text-gray-400">문항 유형: 한 줄/여러 줄 텍스트, 라디오, 체크박스, 드롭다운, 날짜, 동의. 선택지는 한 줄에 하나씩 입력합니다.</p>

    <template x-if="questions.length === 0">
        <p class="text-sm text-gray-400 py-6 text-center">등록된 문항이 없습니다. ‘문항 추가’ 또는 ‘기본 문항 불러오기’를 눌러주세요.</p>
    </template>

    <template x-for="(q, idx) in questions" :key="idx">
        <div class="border border-gray-200 rounded-md p-4 space-y-3">
            <input type="hidden" :name="`questions[${idx}][id]`" :value="q.id">
            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-400 w-6" x-text="idx+1"></span>
                <input type="text" :name="`questions[${idx}][label]`" x-model="q.label" placeholder="문항 라벨 (예: 성명)"
                       class="flex-1 rounded-md border-gray-300 shadow-sm text-sm">
                <select :name="`questions[${idx}][type]`" x-model="q.type" class="rounded-md border-gray-300 shadow-sm text-sm">
                    <option value="text">한 줄 텍스트</option>
                    <option value="textarea">여러 줄 텍스트</option>
                    <option value="radio">라디오(단일)</option>
                    <option value="checkbox">체크박스(복수)</option>
                    <option value="select">드롭다운</option>
                    <option value="date">날짜</option>
                    <option value="agreement">동의</option>
                </select>
                <label class="flex items-center gap-1 text-sm text-gray-600 whitespace-nowrap">
                    <input type="checkbox" :name="`questions[${idx}][is_required]`" value="1" x-model="q.required" class="rounded border-gray-300 text-blue-600"> 필수
                </label>
                <button type="button" @click="questions.splice(idx,1)" class="text-red-500 hover:text-red-700 text-sm px-2">삭제</button>
            </div>
            <div x-show="needsOptions(q.type)" x-cloak>
                <textarea :name="`questions[${idx}][options]`" x-model="q.options" rows="3" placeholder="선택지 (한 줄에 하나씩)"
                          class="w-full rounded-md border-gray-300 shadow-sm text-sm"></textarea>
            </div>
        </div>
    </template>
</div>
