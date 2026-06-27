@props(['type' => 'info'])

@php
$classes = match($type) {
    'success' => 'bg-green-50 text-green-700 border-green-300',
    'warning' => 'bg-yellow-50 text-yellow-700 border-yellow-300',
    'danger' => 'bg-red-50 text-red-700 border-red-300',
    default => 'bg-blue-50 text-blue-700 border-blue-300',
};
@endphp

<span {{ $attributes->merge(['class' => "inline-block px-2 py-0.5 text-xs border $classes"]) }}>
    {{ $slot }}
</span>
