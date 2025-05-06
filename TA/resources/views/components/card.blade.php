@props(['header' => null])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    @if($header)
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $header }}
            </h3>
        </div>
    @endif
    <div class="p-6 bg-white border-b border-gray-200">
        {{ $slot }}
    </div>
</div>
