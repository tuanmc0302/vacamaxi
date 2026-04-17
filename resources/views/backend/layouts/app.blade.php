@php
    $backendUser = auth()->user();
    $productMenuCategories = collect();

    if ($backendUser?->hasPermission('admin.products.view')) {
        try {
            $productMenuCategories = \App\Models\Category::query()
                ->where('module', \App\Models\Category::MODULE_PRODUCT)
                ->where('is_active', true)
                ->has('products', '>=', 4)
                ->withCount('products')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();
        } catch (\Throwable) {
            $productMenuCategories = collect();
        }
    }

    $menuItems = collect(config('menu_aside_backend', []))
        ->map(function (array $item) use ($productMenuCategories) {
            if (($item['route'] ?? null) === 'admin.products.index' && $productMenuCategories->isNotEmpty()) {
                $item['children'] = $productMenuCategories
                    ->map(fn ($category) => [
                        'title' => $category->name . ' (' . $category->products_count . ')',
                        'route' => 'admin.products.index',
                        'params' => ['category_id' => $category->id],
                        'permission' => 'admin.products.view',
                    ])
                    ->all();
            }

            return $item;
        })
        ->filter(fn (array $item) => ! isset($item['permission']) || $backendUser?->hasPermission($item['permission']))
        ->values();

    $iconMap = [
        'home' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 9.75V21h13.5V9.75"/></svg>',
        'users' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 19a4 4 0 0 0-8 0"/><circle cx="12" cy="11" r="3"/><path stroke-linecap="round" stroke-linejoin="round" d="M20 19a4 4 0 0 0-3-3.87"/><path stroke-linecap="round" stroke-linejoin="round" d="M17 8a3 3 0 1 1 0 6"/></svg>',
        'shield' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 3v6c0 4.5-2.9 7.74-7 9-4.1-1.26-7-4.5-7-9V6l7-3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m9.5 12 1.7 1.7L14.8 10"/></svg>',
        'box' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="m21 8.5-9-5-9 5 9 5 9-5Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 8.5v7l9 5 9-5v-7"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 13.5v7"/></svg>',
        'file' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3.75h6.25L17 7.5v12.75H7V3.75Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 3.75V8h4"/><path stroke-linecap="round" stroke-linejoin="round" d="M9.5 12h5M9.5 15h5"/></svg>',
        'grid' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm10 0h6v6h-6v-6Z"/></svg>',
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin | Quản trị hệ thống')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        .select2-container { width: 100% !important; }
        .select2-container--default .select2-selection--multiple,
        .select2-container--default .select2-selection--single {
            min-height: 48px;
            border-radius: 0.75rem;
            border: 1px solid rgb(226 232 240);
            background: white;
            padding: 0.375rem 0.5rem;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            border: 1px solid rgb(191 219 254);
            background: rgb(239 246 255);
            color: rgb(30 41 59);
            border-radius: 9999px;
            padding: 0.2rem 0.6rem;
        }
        .select2-dropdown {
            border: 1px solid rgb(226 232 240);
            border-radius: 0.75rem;
            overflow: hidden;
            background: white;
        }
        .select2-results__option {
            padding: 0.75rem 1rem;
            color: rgb(30 41 59);
        }
        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background: rgb(37 99 235);
            color: white;
        }
        .admin-menu-details > summary { list-style: none; }
        .admin-menu-details > summary::-webkit-details-marker { display: none; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="min-h-screen">
        <div class="flex min-h-screen">
            <aside class="hidden w-72 border-r border-slate-200 bg-white lg:block">
                <div class="border-b border-slate-200 px-6 py-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-blue-600">Quản trị hệ thống</p>
                    <h2 class="mt-3 text-xl font-bold text-slate-900">{{ $backendUser?->full_name }}</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ $backendUser?->username }}</p>
                </div>

                <nav class="space-y-1 px-4 py-4">
                    @foreach ($menuItems as $item)
                        @php
                            $children = collect($item['children'] ?? [])
                                ->filter(fn (array $child) => ! isset($child['permission']) || $backendUser?->hasPermission($child['permission']))
                                ->values();
                            $routePrefix = str($item['route'])->beforeLast('.')->append('.*')->toString();
                            $itemActive = request()->routeIs($item['route']) || request()->routeIs($routePrefix);
                            $childActive = $children->contains(function (array $child) {
                                if (! request()->routeIs($child['route'])) {
                                    return false;
                                }

                                $params = $child['params'] ?? [];

                                return ! isset($params['category_id']) || (string) request('category_id') === (string) $params['category_id'];
                            });
                            $active = $itemActive || $childActive;
                            $icon = $iconMap[$item['icon']] ?? $iconMap['home'];
                            $baseClass = $active ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900';
                        @endphp

                        @if ($children->isNotEmpty())
                            <details class="admin-menu-details group rounded-xl" {{ $active ? 'open' : '' }}>
                                <summary class="{{ $baseClass }} flex cursor-pointer items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition">
                                    <span class="shrink-0">{!! $icon !!}</span>
                                    <span class="flex-1">{{ $item['title'] }}</span>
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4 transition group-open:rotate-180">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                                    </svg>
                                </summary>
                                <div class="mt-1 space-y-1 pl-11">
                                    <a href="{{ route($item['route'], $item['params'] ?? []) }}" class="{{ $itemActive && ! request('category_id') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }} block rounded-lg px-3 py-2 text-xs font-medium transition">Tất cả sản phẩm</a>
                                    @foreach ($children as $child)
                                        @php
                                            $params = $child['params'] ?? [];
                                            $isChildActive = request()->routeIs($child['route']) && (! isset($params['category_id']) || (string) request('category_id') === (string) $params['category_id']);
                                        @endphp
                                        <a href="{{ route($child['route'], $params) }}" class="{{ $isChildActive ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }} block rounded-lg px-3 py-2 text-xs font-medium transition">{{ $child['title'] }}</a>
                                    @endforeach
                                </div>
                            </details>
                        @else
                            <a href="{{ route($item['route'], $item['params'] ?? []) }}" class="{{ $baseClass }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition">
                                <span class="shrink-0">{!! $icon !!}</span>
                                <span>{{ $item['title'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </nav>
            </aside>

            <div class="flex-1">
                <header class="border-b border-slate-200 bg-white">
                    <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-5">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-blue-600">@yield('eyebrow', 'Quản trị hệ thống')</p>
                            <h1 class="mt-2 text-2xl font-bold text-slate-900">@yield('page_heading', 'Bảng điều khiển')</h1>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                </header>

                <main class="mx-auto w-full max-w-7xl px-6 py-8">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <div id="confirm-delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/40 px-4">
        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 id="confirm-delete-title" class="text-lg font-semibold text-slate-900">Xác nhận xóa</h3>
                    <p id="confirm-delete-message" class="mt-2 text-sm leading-6 text-slate-500">Bạn có chắc chắn muốn xóa dữ liệu này không?</p>
                </div>
                <button type="button" class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700" data-close-confirm-delete>
                    <span class="sr-only">Đóng</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6 18 18M18 6 6 18" />
                    </svg>
                </button>
            </div>

            <form id="confirm-delete-form" method="POST" class="mt-6 flex items-center justify-end gap-3">
                @csrf
                @method('DELETE')
                <button type="button" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100" data-close-confirm-delete>Hủy</button>
                <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">Xác nhận xóa</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.js-select2').each(function () {
                const $select = $(this);
                $select.select2({
                    width: '100%',
                    placeholder: $select.data('placeholder') || '',
                    closeOnSelect: !$select.prop('multiple'),
                });
            });

            const modal = document.getElementById('confirm-delete-modal');
            const form = document.getElementById('confirm-delete-form');
            const titleElement = document.getElementById('confirm-delete-title');
            const messageElement = document.getElementById('confirm-delete-message');

            if (!modal || !form || !titleElement || !messageElement) return;

            const closeModal = function () {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                form.setAttribute('action', '#');
            };

            document.querySelectorAll('[data-confirm-delete="true"]').forEach(function (button) {
                button.addEventListener('click', function () {
                    form.setAttribute('action', button.dataset.action || '#');
                    titleElement.textContent = button.dataset.title || 'Xác nhận xóa';
                    messageElement.textContent = button.dataset.message || 'Bạn có chắc chắn muốn xóa dữ liệu này không?';
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });

            document.querySelectorAll('[data-close-confirm-delete]').forEach(function (button) {
                button.addEventListener('click', closeModal);
            });

            modal.addEventListener('click', function (event) {
                if (event.target === modal) closeModal();
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
            });
        });
    </script>
    @stack('scripts')
</body>
</html>