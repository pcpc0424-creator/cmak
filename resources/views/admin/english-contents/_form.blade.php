@csrf
<div class="bg-white rounded-lg shadow p-6 space-y-5">
    {{-- Slug --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Slug (URL 경로) <span class="text-red-500">*</span>
        </label>
        <div class="flex items-center">
            <span class="inline-flex items-center px-3 h-10 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-sm text-gray-500 font-mono">/cmak/eng/</span>
            <input type="text" name="slug" value="{{ old('slug', $content->slug ?? '') }}" required
                   class="flex-1 h-10 rounded-r-md border-gray-300 shadow-sm text-sm font-mono"
                   placeholder="about/greeting">
        </div>
        <p class="mt-1 text-xs text-gray-500">예: about/greeting, cmday/celebrations, news/publications</p>
        @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Section --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            섹션 <span class="text-red-500">*</span>
        </label>
        <select name="section" required class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm text-sm">
            @foreach($sectionLabels as $key => $label)
                <option value="{{ $key }}" {{ old('section', $content->section ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @error('section') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Title --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            제목 (Title) <span class="text-red-500">*</span>
        </label>
        <input type="text" name="title" value="{{ old('title', $content->title ?? '') }}" required
               class="w-full rounded-md border-gray-300 shadow-sm text-sm">
        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Description --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            설명 (Description)
        </label>
        <input type="text" name="description" value="{{ old('description', $content->description ?? '') }}"
               class="w-full rounded-md border-gray-300 shadow-sm text-sm"
               placeholder="페이지 상단에 표시되는 짧은 설명">
        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Eyebrow (optional) --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Eyebrow / 라벨
        </label>
        <input type="text" name="eyebrow" value="{{ old('eyebrow', $content->eyebrow ?? '') }}"
               class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm text-sm"
               placeholder="홈 페이지 슬라이드 등에서 사용">
    </div>

    {{-- Hero Image (optional) --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Hero Image 경로
        </label>
        <input type="text" name="hero_image" value="{{ old('hero_image', $content->hero_image ?? '') }}"
               class="w-full rounded-md border-gray-300 shadow-sm text-sm"
               placeholder="/cmak/images/eng/eng1.jpg">
    </div>

    {{-- Body content (HTML override) --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            본문 (HTML)
        </label>
        <textarea name="content" rows="20"
                  class="w-full rounded-md border-gray-300 shadow-sm text-sm font-mono"
                  placeholder="비워두면 기본 디자인 본문이 표시됩니다. 여기에 HTML을 입력하면 본문 영역을 덮어씁니다.">{{ old('content', $content->content ?? '') }}</textarea>
        <p class="mt-1 text-xs text-gray-500">
            ※ 본문을 비워두면 코드에 작성된 기본 레이아웃 (히어로/타임라인/갤러리 등) 이 그대로 표시됩니다.<br>
            ※ HTML을 입력하면 해당 영역을 덮어씁니다. <code class="px-1 bg-gray-100 rounded">&lt;h3&gt; &lt;p&gt; &lt;ul&gt; &lt;table&gt;</code> 등 사용 가능.
        </p>
    </div>

    {{-- Sort order & Published --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">정렬 순서</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $content->sort_order ?? 0) }}"
                   class="w-32 rounded-md border-gray-300 shadow-sm text-sm">
        </div>
        <div class="flex items-end">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_published" value="1"
                       {{ old('is_published', $content->is_published ?? true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 shadow-sm">
                <span class="ml-2 text-sm text-gray-700">발행 (체크 해제 시 페이지 비공개)</span>
            </label>
        </div>
    </div>
</div>

<div class="mt-6 flex items-center justify-between">
    <a href="{{ url('/admin/english-contents') }}"
       class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition">
        취소
    </a>
    <button type="submit"
            class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
        저장
    </button>
</div>
