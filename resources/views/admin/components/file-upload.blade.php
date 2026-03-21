@props([
    'name' => 'file',
    'multiple' => false,
    'accept' => '*/*',
])

<div
    x-data="{
        dragging: false,
        files: [],
        handleDrop(e) {
            this.dragging = false;
            this.files = Array.from(e.dataTransfer.files);
            this.$refs.input.files = e.dataTransfer.files;
        },
        handleSelect(e) {
            this.files = Array.from(e.target.files);
        },
        removeFile(index) {
            this.files.splice(index, 1);
            if (this.files.length === 0) {
                this.$refs.input.value = '';
            }
        }
    }"
    class="w-full"
>
    <div
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="handleDrop($event)"
        @click="$refs.input.click()"
        :class="dragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300 bg-white'"
        class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed px-6 py-8 transition-colors hover:border-blue-400 hover:bg-gray-50"
    >
        <svg class="mb-2 h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
        </svg>
        <p class="text-sm text-gray-600">파일을 드래그하거나 <span class="font-medium text-blue-600">클릭하여 선택</span>하세요</p>
        <p class="mt-1 text-xs text-gray-400">{{ $accept !== '*/*' ? $accept : '모든 파일 형식' }}</p>
    </div>

    <input
        x-ref="input"
        type="file"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        accept="{{ $accept }}"
        {{ $multiple ? 'multiple' : '' }}
        @change="handleSelect($event)"
        class="hidden"
    />

    <template x-if="files.length > 0">
        <ul class="mt-3 space-y-1">
            <template x-for="(file, index) in files" :key="index">
                <li class="flex items-center justify-between rounded-md bg-gray-50 px-3 py-2 text-sm">
                    <span class="truncate text-gray-700" x-text="file.name"></span>
                    <button
                        type="button"
                        @click.stop="removeFile(index)"
                        class="ml-2 text-gray-400 hover:text-red-500"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </li>
            </template>
        </ul>
    </template>
</div>
