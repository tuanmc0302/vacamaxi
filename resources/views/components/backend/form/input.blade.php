@props([
    'id',
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'placeholder' => null,
])

<div>
    <label for="{{ $id }}" class="mb-2 block text-sm font-medium text-slate-700">{{ $label }}</label>
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        @required($required)
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        {{ $attributes->class(['block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100']) }}
    >
</div>
