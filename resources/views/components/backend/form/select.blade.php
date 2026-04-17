@props([
    'id',
    'name',
    'label',
    'multiple' => false,
    'placeholder' => null,
    'hint' => null,
])

<div>
    <label for="{{ $id }}" class="mb-2 block text-sm font-medium text-slate-700">{{ $label }}</label>
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        @if ($multiple) multiple @endif
        data-placeholder="{{ $placeholder }}"
        {{ $attributes->class([$multiple ? 'js-select2' : '', 'w-full']) }}
    >
        {{ $slot }}
    </select>

    @if ($hint)
        <p class="mt-2 text-xs text-slate-500">{{ $hint }}</p>
    @endif
</div>
