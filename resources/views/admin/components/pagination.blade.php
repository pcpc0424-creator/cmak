@props([
    'paginator' => null,
])

@if($paginator && $paginator->hasPages())
    <div class="mt-4 flex items-center justify-center">
        {{ $paginator->withQueryString()->links() }}
    </div>
@endif
