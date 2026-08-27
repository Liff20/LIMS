@props(['id', 'title'])

<div x-data="{ open: false }"
    x-on:open-modal.window="if ($event.detail === '{{ $id }}') open = true"
    x-on:close-modal.window="open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none">
    <div class="absolute inset-0 bg-black/40" x-on:click="open = false"></div>
    <div class="relative w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl" x-on:click.stop>
        <div class="mb-4 flex items-center justify-between">
            <h3 class="text-lg font-bold text-deep-space-600">{{ $title }}</h3>
            <button type="button" class="btn-ghost !p-1.5" x-on:click="open = false">
                <x-icon name="x" class="h-5 w-5" />
            </button>
        </div>
        {{ $slot }}
    </div>
</div>
