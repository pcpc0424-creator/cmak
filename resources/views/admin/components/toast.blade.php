<div
    x-data="{
        toasts: [],
        init() {
            @if(session('success'))
                this.addToast('success', '{{ session('success') }}');
            @endif
            @if(session('error'))
                this.addToast('error', '{{ session('error') }}');
            @endif
        },
        addToast(type, message) {
            const id = Date.now();
            this.toasts.push({ id, type, message });
            setTimeout(() => this.removeToast(id), 3000);
        },
        removeToast(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }"
    class="fixed right-4 top-4 z-[100] flex flex-col gap-2"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-transition:enter="transition duration-300 ease-out"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition duration-200 ease-in"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            :class="toast.type === 'success' ? 'border-green-400 bg-green-50 text-green-800' : 'border-red-400 bg-red-50 text-red-800'"
            class="flex min-w-[300px] items-center gap-3 rounded-lg border px-4 py-3 shadow-lg"
        >
            <template x-if="toast.type === 'success'">
                <svg class="h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </template>
            <template x-if="toast.type === 'error'">
                <svg class="h-5 w-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </template>
            <span class="text-sm font-medium" x-text="toast.message"></span>
            <button @click="removeToast(toast.id)" class="ml-auto text-gray-400 hover:text-gray-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </template>
</div>
