@props([
    'title' => '삭제 확인',
    'message' => '정말 삭제하시겠습니까? 이 작업은 되돌릴 수 없습니다.',
    'confirmText' => '삭제',
    'cancelText' => '취소',
])

<div
    x-data="{
        show: false,
        formAction: '',
        init() {
            this.$watch('show', value => {
                document.body.classList.toggle('overflow-hidden', value);
            });
        }
    }"
    @confirm-modal.window="show = true; formAction = $event.detail?.action || ''"
    x-cloak
>
    <template x-if="show">
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            {{-- Backdrop --}}
            <div
                class="fixed inset-0 bg-black/50 transition-opacity"
                @click="show = false"
            ></div>

            {{-- Modal card --}}
            <div class="relative z-10 w-full max-w-md rounded-lg bg-white p-6 shadow-xl">
                <div class="mb-4 flex items-center gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-100">
                        <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                </div>

                <p class="mb-6 text-sm text-gray-600">{{ $message }}</p>

                <div class="flex justify-end gap-3">
                    <button
                        type="button"
                        @click="show = false"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    >
                        {{ $cancelText }}
                    </button>
                    <form :action="formAction" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                        >
                            {{ $confirmText }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
