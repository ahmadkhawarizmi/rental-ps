@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-lg bg-navy-50 px-3 py-2.5 text-start text-base font-medium text-navy-900'
            : 'block w-full rounded-lg px-3 py-2.5 text-start text-base font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
