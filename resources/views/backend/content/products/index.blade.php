@extends('backend.layouts.app')

@section('title', 'Sản phẩm | Admin')
@section('eyebrow', 'Quản trị nội dung')
@section('page_heading', 'Sản phẩm')

@section('content')
    <div class="space-y-6">
        @if (session('status'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <form method="GET" action="{{ route('admin.products.index') }}" class="grid gap-4 md:grid-cols-[1fr_240px_auto]">
                <input type="text" name="keyword" value="{{ $filters['keyword'] ?? '' }}" placeholder="Tìm theo tên sản phẩm" class="h-12 rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                <select name="category_id" class="h-12 rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) ($filters['category_id'] ?? '') === (string) $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="flex gap-3">
                    <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">Lọc</button>
                    <a href="{{ route('admin.products.create') }}" class="inline-flex h-12 items-center justify-center rounded-xl bg-slate-900 px-5 text-sm font-semibold text-white transition hover:bg-slate-800">Thêm mới</a>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Sản phẩm</th>
                        <th class="px-5 py-4">Danh mục</th>
                        <th class="px-5 py-4">Thứ tự</th>
                        <th class="px-5 py-4">Trạng thái</th>
                        <th class="px-5 py-4 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="h-16 w-24 overflow-hidden rounded-xl bg-slate-100">
                                        @if ($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                                        <p class="mt-1 text-xs text-slate-500">/{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-slate-600">{{ $product->category?->name ?: '-' }}</td>
                            <td class="px-5 py-4 text-slate-600">{{ $product->sort_order }}</td>
                            <td class="px-5 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $product->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $product->is_active ? 'Đang bật' : 'Đang tắt' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">Sửa</a>
                                    <button type="button" data-confirm-delete="true" data-action="{{ route('admin.products.destroy', $product) }}" data-title="Xóa sản phẩm" data-message="Bạn có chắc chắn muốn xóa sản phẩm {{ $product->name }}?" class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">Xóa</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-slate-500">Chưa có sản phẩm.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $products->links() }}
    </div>
@endsection