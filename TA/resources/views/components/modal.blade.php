@props(['id', 'maxWidth', 'show' => false, 'name' => null])

@php
$id = $id ?? $name ?? uniqid('modal_');

$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth ?? '2xl'];
@endphp

<div
    x-data="{ show: {{ $show ? 'true' : 'false' }} }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:open-modal.window="$event.detail === '{{ $id }}' ? show = true : null"
    x-show="show"
    id="{{ $id }}"
    class="fixed inset-0 z-50 px-4 py-6 sm:px-0 overflow-y-auto"
    style="display: none;"
>
    <div class="fixed inset-0 transform transition-all" x-on:click="show = false">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
                    x-show="show"
                    x-trap.noscroll.inert="show">
        {{ $slot }}
    </div>
</div>
