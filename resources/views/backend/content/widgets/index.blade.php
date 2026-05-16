@extends('backend.layouts.app')

@section('title', 'Admin | Widget frontend')
@section('eyebrow', 'Frontend')
@section('page_heading', 'Cấu hình widget frontend')

@section('content')
    <x-backend.panel>
        <x-backend.alert class="mb-6" :message="session('status')" />
        <x-backend.page-header kicker="Widget" title="Danh sách widget frontend" description="Kéo thả để đổi thứ tự, bật tắt nhanh tại danh sách, hoặc vào sửa để cập nhật nội dung từng section." />
        @php
            $currentPage = $currentPage ?? 'home';
            $pageTabs = [
                'home' => 'Trang chủ',
                'about' => 'Giới thiệu',
                'about-scale' => 'Giới thiệu quy mô',
                'restaurant' => 'Dịch vụ - Nhà hàng',
            ];
        @endphp

        <div class="mt-5 flex flex-wrap gap-2">
            @foreach ($pageTabs as $pageKey => $label)
                <a href="{{ route('admin.widgets.index', ['page' => $pageKey]) }}"
                   class="inline-flex items-center rounded-lg border px-3 py-2 text-sm font-medium transition {{ $currentPage === $pageKey ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-slate-300 text-slate-600 hover:bg-slate-50' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div id="widget-status" class="mt-6 hidden rounded-xl border px-4 py-3 text-sm font-medium"></div>

        <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="w-16 px-5 py-4 font-semibold">Kéo</th>
                        <th class="px-5 py-4 font-semibold">Key</th>
                        <th class="px-5 py-4 font-semibold">Title</th>
                        <th class="px-5 py-4 font-semibold">Sub title</th>
                        <th class="px-5 py-4 font-semibold">Thứ tự</th>
                        <th class="px-5 py-4 font-semibold">Trạng thái</th>
                        <th class="px-5 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="widget-sortable" class="divide-y divide-slate-200 bg-white text-slate-700">
                    @foreach ($widgets as $widget)
                        <tr class="widget-row hover:bg-slate-50" data-widget-id="{{ $widget->id }}" draggable="true">
                            <td class="px-5 py-4">
                                <button type="button" class="drag-handle cursor-grab rounded-lg border border-slate-200 px-2 py-1 text-slate-400 active:cursor-grabbing" title="Kéo để đổi thứ tự">⋮⋮</button>
                            </td>
                            <td class="px-5 py-4 font-mono text-xs text-slate-500">{{ $widget->key }}</td>
                            <td class="px-5 py-4 font-medium text-slate-900">{{ $widget->title }}</td>
                            <td class="px-5 py-4">{{ $widget->sub_title }}</td>
                            <td class="sort-order-cell px-5 py-4">{{ $widget->sort_order }}</td>
                            <td class="px-5 py-4">
                                <label class="inline-flex cursor-pointer items-center gap-3">
                                    <input type="checkbox" class="widget-toggle peer sr-only" data-action="{{ route('admin.widgets.toggle', $widget) }}" @checked($widget->is_active)>
                                    <span class="h-6 w-11 rounded-full bg-slate-200 p-1 transition peer-checked:bg-emerald-500">
                                        <span class="block h-4 w-4 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>
                                    </span>
                                    <span class="toggle-label text-sm font-medium {{ $widget->is_active ? 'text-emerald-700' : 'text-slate-500' }}">{{ $widget->is_active ? 'Hiển thị' : 'Ẩn' }}</span>
                                </label>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('admin.widgets.edit', ['widget' => $widget, 'page' => $currentPage]) }}" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">Sửa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-backend.panel>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tbody = document.getElementById('widget-sortable');
            const statusBox = document.getElementById('widget-status');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            let draggedRow = null;

            const showStatus = function (message, type = 'success') {
                statusBox.textContent = message;
                statusBox.classList.remove('hidden', 'border-emerald-200', 'bg-emerald-50', 'text-emerald-700', 'border-red-200', 'bg-red-50', 'text-red-700');
                if (type === 'error') {
                    statusBox.classList.add('border-red-200', 'bg-red-50', 'text-red-700');
                } else {
                    statusBox.classList.add('border-emerald-200', 'bg-emerald-50', 'text-emerald-700');
                }
            };

            const refreshOrderNumbers = function () {
                tbody.querySelectorAll('.widget-row').forEach(function (row, index) {
                    row.querySelector('.sort-order-cell').textContent = index;
                });
            };

            const persistOrder = function () {
                const ids = Array.from(tbody.querySelectorAll('.widget-row')).map(function (row) {
                    return Number(row.dataset.widgetId);
                });

                fetch('{{ route('admin.widgets.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ widgets: ids, page: @json($currentPage) }),
                })
                    .then(function (response) {
                        if (!response.ok) throw new Error('Không lưu được thứ tự widget.');
                        return response.json();
                    })
                    .then(function (data) {
                        showStatus(data.message || 'Đã cập nhật thứ tự widget.');
                    })
                    .catch(function (error) {
                        showStatus(error.message || 'Không lưu được thứ tự widget.', 'error');
                    });
            };

            tbody.querySelectorAll('.widget-row').forEach(function (row) {
                row.addEventListener('dragstart', function () {
                    draggedRow = row;
                    row.classList.add('opacity-50');
                });

                row.addEventListener('dragend', function () {
                    row.classList.remove('opacity-50');
                    draggedRow = null;
                });

                row.addEventListener('dragover', function (event) {
                    event.preventDefault();
                    if (!draggedRow || draggedRow === row) return;

                    const rect = row.getBoundingClientRect();
                    const isAfter = event.clientY > rect.top + rect.height / 2;
                    tbody.insertBefore(draggedRow, isAfter ? row.nextSibling : row);
                });

                row.addEventListener('drop', function () {
                    refreshOrderNumbers();
                    persistOrder();
                });
            });

            document.querySelectorAll('.widget-toggle').forEach(function (toggle) {
                toggle.addEventListener('change', function () {
                    const label = toggle.closest('label').querySelector('.toggle-label');
                    const previous = !toggle.checked;

                    fetch(toggle.dataset.action, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({ is_active: toggle.checked ? 1 : 0 }),
                    })
                        .then(function (response) {
                            if (!response.ok) throw new Error('Không cập nhật được trạng thái widget.');
                            return response.json();
                        })
                        .then(function (data) {
                            label.textContent = data.is_active ? 'Hiển thị' : 'Ẩn';
                            label.classList.toggle('text-emerald-700', data.is_active);
                            label.classList.toggle('text-slate-500', !data.is_active);
                            showStatus(data.message || 'Đã cập nhật trạng thái widget.');
                        })
                        .catch(function (error) {
                            toggle.checked = previous;
                            showStatus(error.message || 'Không cập nhật được trạng thái widget.', 'error');
                        });
                });
            });
        });
    </script>
@endpush
