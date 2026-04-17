@props([
    'action',
    'title' => 'Xác nhận xóa',
    'message' => 'Bạn có chắc chắn muốn xóa dữ liệu này không?',
    'label' => 'Xóa',
])

<button
    type="button"
    class="inline-flex items-center rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
    data-confirm-delete="true"
    data-action="{{ $action }}"
    data-title="{{ $title }}"
    data-message="{{ $message }}"
>
    {{ $label }}
</button>
