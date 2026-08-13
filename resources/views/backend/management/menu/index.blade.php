@extends('backend.layouts.app')

@section('title', 'Admin | Quản lý menu')
@section('eyebrow', 'Frontend')
@section('page_heading', 'Quản lý menu')

@php
    $renderMenuNode = function ($item) use (&$renderMenuNode, $__env) {
        $children = $item->children ?? collect();
@endphp
        <li class="menu-node rounded-2xl border border-slate-200 bg-white p-3 shadow-sm" data-id="{{ $item->id }}">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex min-w-0 items-center gap-3">
                    <button type="button" class="menu-drag-handle cursor-grab rounded-xl border border-slate-200 px-3 py-2 text-slate-400 transition hover:border-amber-300 hover:text-amber-500 active:cursor-grabbing" title="Kéo để đổi vị trí">
                        <i class="bi bi-grip-vertical"></i>
                    </button>
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-semibold text-slate-900">{{ $item->label }}</span>
                            @if (! $item->is_active)
                                <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-500">Đang ẩn</span>
                            @endif
                            @if ($item->key)
                                <span class="rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700">{{ $item->key }}</span>
                            @endif
                        </div>
                        <p class="mt-1 truncate text-xs text-slate-500">{{ $item->url ?: '#' }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button type="button"
                            class="menu-edit-btn rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-50"
                            data-id="{{ $item->id }}"
                            data-label="{{ e($item->label) }}"
                            data-label-en="{{ e($item->label_en) }}"
                            data-url="{{ e($item->url) }}"
                            data-url-en="{{ e($item->url_en) }}"
                            data-key="{{ e($item->key) }}"
                            data-target="{{ e($item->target) }}"
                            data-active="{{ $item->is_active ? 1 : 0 }}"
                            data-action="{{ route('admin.menu.update', $item) }}">
                        Sửa
                    </button>
                    <button type="button" class="menu-delete-btn rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50" data-id="{{ $item->id }}">
                        Xóa
                    </button>
                </div>
            </div>

            <ol class="menu-children menu-sortable mt-3 min-h-6 space-y-2 rounded-xl border border-dashed border-slate-200 bg-slate-50/60 p-2" data-parent-id="{{ $item->id }}">
                @foreach ($children as $child)
                    {!! $renderMenuNode($child) !!}
                @endforeach
            </ol>
        </li>
@php
    };
@endphp

@push('styles')
    <style>
        .menu-sortable-empty::before {
            content: "Thả menu con vào đây";
            display: block;
            padding: 0.5rem;
            color: rgb(148 163 184);
            font-size: 0.75rem;
        }
        .sortable-ghost {
            opacity: 0.45;
            background: #fff7e0 !important;
            border: 1px dashed #e9ad00 !important;
        }
        .sortable-chosen {
            box-shadow: 0 16px 38px rgba(15, 23, 42, 0.14) !important;
        }
    </style>
@endpush

@section('content')
    <div class="grid gap-6 lg:grid-cols-[380px_minmax(0,1fr)]">
        <x-backend.panel>
            <x-backend.alert class="mb-5" type="error" :message="$errors->first()" />
            <x-backend.page-header kicker="Menu" title="Thêm mục menu" description="Tạo menu cha hoặc chọn menu cha để tạo menu con." />

            <form id="menu-form" class="mt-6 space-y-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tiêu đề (VI)</label>
                    <input type="text" name="label" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" placeholder="Trang chủ, Giới thiệu..." required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tiêu đề (EN)</label>
                    <input type="text" name="label_en" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" placeholder="Home, About Us...">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Đường dẫn (VI)</label>
                    <input type="text" name="url" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" placeholder="/gioi-thieu, https://...">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Đường dẫn (EN)</label>
                    <input type="text" name="url_en" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" placeholder="/en/about, https://...">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Key active</label>
                    <input type="text" name="key" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" placeholder="home, about, product...">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Menu cha</label>
                    <select name="parent_id" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <option value="">Cấp cao nhất</option>
                        @foreach($menuItems as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Target</label>
                        <select name="target" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            <option value="_self">Cùng tab</option>
                            <option value="_blank">Tab mới</option>
                        </select>
                    </div>
                    <label class="mt-7 flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        Hiển thị
                    </label>
                </div>

                <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Lưu mục menu
                </button>
            </form>
        </x-backend.panel>

        <x-backend.panel>
            <x-backend.page-header kicker="Menu" title="Cấu trúc menu" description="Kéo menu cha để đổi thứ tự. Kéo menu con sang vùng con của menu khác để đổi cha." />

            <div id="menu-status" class="mt-5 hidden rounded-xl border px-4 py-3 text-sm font-medium"></div>

            <ol id="menu-tree" class="menu-root menu-sortable mt-7 min-h-16 space-y-3 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-3">
                @foreach($menuItems as $item)
                    {!! $renderMenuNode($item) !!}
                @endforeach
            </ol>
        </x-backend.panel>
    </div>

    <div id="menu-edit-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/40 px-4">
        <div class="w-full max-w-xl rounded-2xl bg-white p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">Sửa mục menu</h3>
                    <p class="mt-1 text-sm text-slate-500">Cập nhật tiêu đề, đường dẫn, key active và trạng thái hiển thị.</p>
                </div>
                <button type="button" class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700" data-close-edit>
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <form id="menu-edit-form" class="mt-6 space-y-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tiêu đề (VI)</label>
                    <input type="text" name="label" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tiêu đề (EN)</label>
                    <input type="text" name="label_en" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Đường dẫn (VI)</label>
                    <input type="text" name="url" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Đường dẫn (EN)</label>
                    <input type="text" name="url_en" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Key active</label>
                    <input type="text" name="key" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Target</label>
                        <select name="target" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            <option value="_self">Cùng tab</option>
                            <option value="_blank">Tab mới</option>
                        </select>
                    </div>
                    <label class="mt-7 flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700">
                        <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        Hiển thị
                    </label>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100" data-close-edit>Hủy</button>
                    <button type="submit" class="rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const statusBox = document.getElementById('menu-status');
            const rootList = document.getElementById('menu-tree');
            const editModal = document.getElementById('menu-edit-modal');
            const editForm = document.getElementById('menu-edit-form');

            const showStatus = function (message, type = 'success') {
                statusBox.textContent = message;
                statusBox.classList.remove('hidden', 'border-emerald-200', 'bg-emerald-50', 'text-emerald-700', 'border-red-200', 'bg-red-50', 'text-red-700');
                statusBox.classList.add(type === 'error' ? 'border-red-200' : 'border-emerald-200', type === 'error' ? 'bg-red-50' : 'bg-emerald-50', type === 'error' ? 'text-red-700' : 'text-emerald-700');
            };

            const refreshEmptyStates = function () {
                document.querySelectorAll('.menu-children').forEach(function (list) {
                    list.classList.toggle('menu-sortable-empty', list.querySelectorAll(':scope > .menu-node').length === 0);
                });
            };

            const directNodes = function (list) {
                return Array.from(list.children).filter(function (child) {
                    return child.classList.contains('menu-node');
                });
            };

            const buildTree = function (list) {
                return directNodes(list).map(function (node) {
                    const childrenList = node.querySelector(':scope > .menu-children');

                    return {
                        id: Number(node.dataset.id),
                        children: childrenList ? buildTree(childrenList) : [],
                    };
                });
            };

            const persistOrder = function () {
                refreshEmptyStates();

                fetch('{{ route("admin.menu.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ items: buildTree(rootList) }),
                })
                    .then(function (response) {
                        if (!response.ok) throw new Error('Không lưu được thứ tự menu.');
                        return response.json();
                    })
                    .then(function (data) {
                        showStatus(data.message || 'Đã cập nhật thứ tự menu.');
                    })
                    .catch(function (error) {
                        showStatus(error.message || 'Không lưu được thứ tự menu.', 'error');
                    });
            };

            const initSortable = function () {
                document.querySelectorAll('.menu-sortable').forEach(function (list) {
                    if (list.dataset.sortableReady === '1') return;
                    list.dataset.sortableReady = '1';

                    new Sortable(list, {
                        animation: 160,
                        handle: '.menu-drag-handle',
                        group: 'frontend-menu',
                        ghostClass: 'sortable-ghost',
                        chosenClass: 'sortable-chosen',
                        fallbackOnBody: true,
                        swapThreshold: 0.65,
                        onEnd: persistOrder,
                    });
                });

                refreshEmptyStates();
            };

            initSortable();

            document.getElementById('menu-form')?.addEventListener('submit', function (event) {
                event.preventDefault();
                const form = event.currentTarget;
                const payload = Object.fromEntries(new FormData(form));
                payload.is_active = form.querySelector('[name="is_active"]').checked ? 1 : 0;

                fetch('{{ route("admin.menu.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(payload),
                })
                    .then(function (response) {
                        if (!response.ok) throw new Error('Không tạo được mục menu.');
                        return response.json();
                    })
                    .then(function () {
                        window.location.reload();
                    })
                    .catch(function (error) {
                        showStatus(error.message || 'Không tạo được mục menu.', 'error');
                    });
            });

            document.addEventListener('click', function (event) {
                const editButton = event.target.closest('.menu-edit-btn');
                const deleteButton = event.target.closest('.menu-delete-btn');
                const closeEditButton = event.target.closest('[data-close-edit]');

                if (closeEditButton) {
                    editModal.classList.add('hidden');
                    editModal.classList.remove('flex');
                }

                if (editButton) {
                    editForm.dataset.action = editButton.dataset.action;
                    editForm.elements.label.value = editButton.dataset.label || '';
                    editForm.elements.label_en.value = editButton.dataset.labelEn || '';
                    editForm.elements.url.value = editButton.dataset.url || '';
                    editForm.elements.url_en.value = editButton.dataset.urlEn || '';
                    editForm.elements.key.value = editButton.dataset.key || '';
                    editForm.elements.target.value = editButton.dataset.target || '_self';
                    editForm.elements.is_active.checked = editButton.dataset.active === '1';
                    editModal.classList.remove('hidden');
                    editModal.classList.add('flex');
                }

                if (deleteButton && confirm('Bạn có chắc muốn xóa mục menu này?')) {
                    fetch(`{{ url('admin/menu') }}/${deleteButton.dataset.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                        .then(function (response) {
                            if (!response.ok) throw new Error('Không xóa được mục menu.');
                            return response.json();
                        })
                        .then(function () {
                            window.location.reload();
                        })
                        .catch(function (error) {
                            showStatus(error.message || 'Không xóa được mục menu.', 'error');
                        });
                }
            });

            editModal?.addEventListener('click', function (event) {
                if (event.target === editModal) {
                    editModal.classList.add('hidden');
                    editModal.classList.remove('flex');
                }
            });

            editForm?.addEventListener('submit', function (event) {
                event.preventDefault();

                const payload = Object.fromEntries(new FormData(editForm));
                payload.is_active = editForm.elements.is_active.checked ? 1 : 0;

                fetch(editForm.dataset.action, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(payload),
                })
                    .then(function (response) {
                        if (!response.ok) throw new Error('Không cập nhật được mục menu.');
                        return response.json();
                    })
                    .then(function () {
                        window.location.reload();
                    })
                    .catch(function (error) {
                        showStatus(error.message || 'Không cập nhật được mục menu.', 'error');
                    });
            });
        });
    </script>
@endpush
