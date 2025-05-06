@props(['variant' => 'primary'])

@php
$baseClasses = 'inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest transition';
$variants = [
    'primary' => 'bg-gray-800 text-white hover:bg-gray-700',
    'secondary' => 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 shadow-sm',
    'danger' => 'bg-red-600 text-white hover:bg-red-500',
    'success' => 'bg-green-600 text-white hover:bg-green-500',
];
$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
    {{ $slot }}
</button>
