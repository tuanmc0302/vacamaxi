@extends('backend.layouts.app')

@php
    $isNews = $module === 'news';
    $indexRoute = $isNews ? 'admin.news-categories.index' : 'admin.product-categories.index';
    $createRoute = $isNews ? 'admin.news-categories.create' : 'admin.product-categories.create';
    $editRoute = $isNews ? 'admin.news-categories.edit' : 'admin.product-categories.edit';
    $destroyRoute = $isNews ? 'admin.news-categories.destroy' : 'admin.product-categories.destroy';
    $heading = $isNews ? 'Danh mục bài viết' : 'Danh mục sản phẩm';
@endphp

@section('title', 'Admin | '.$heading)
@section('eyebrow', 'Danh mục')
@section('page_heading', $heading)

@section('content')
    <x-backend.panel>
        <x-backend.alert class="mb-6" :message="session('status')" />
        <x-backend.alert class="mb-6" type="error" :message="$errors->first()" />
        <x-backend.page-header kicker="{{ $isNews ? 'News' : 'Product' }}" :title="$heading">
            <a href="{{ route($createRoute) }}" class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Thêm danh mục</a>
        </x-backend.page-header>

        <form method="GET" action="{{ route($indexRoute) }}" class="mt-8 grid gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5 md:grid-cols-[minmax(0,1fr),auto]">
            <x-backend.form.input id="keyword" name="keyword" label="Tìm kiếm" :value="$filters['keyword']" placeholder="Nhập tên danh mục" />
            <div class="flex items-end gap-3">
                <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-slate-900 px-5 text-sm font-semibold text-white transition hover:bg-slate-700">Áp dụng</button>
                <a href="{{ route($indexRoute) }}" class="inline-flex h-12 items-center justify-center rounded-xl border border-slate-300 px-5 text-sm font-medium text-slate-700 transition hover:bg-white">Xóa lọc</a>
            </div>
        </form>

        <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Tên</th>
                        <th class="px-5 py-4 font-semibold">Danh mục cha</th>
                        <th class="px-5 py-4 font-semibold">Slug</th>
                        <th class="px-5 py-4 font-semibold">Thứ tự</th>
                        <th class="px-5 py-4 font-semibold">Trạng thái</th>
                        <th class="px-5 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4 font-medium text-slate-900">
                                @if($category->parent_id)
                                    <span class="text-slate-400 mr-1.5 font-bold">↳</span>
                                {{ $category->name }}
                                @if($category->is_18_plus)
                                    <span class="inline-flex items-center rounded-full bg-amber-100 px-2 py-0.5 text-[10px] font-bold text-amber-800 ring-1 ring-inset ring-amber-600/20 ml-1.5" title="Sản phẩm giới hạn độ tuổi 18+">18+</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-xs">
                                @if($category->parent)
                                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ $category->parent->name }}</span>
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 font-mono text-xs">{{ $category->slug }}</td>
                            <td class="px-5 py-4">{{ $category->sort_order }}</td>
                            <td class="px-5 py-4">{{ $category->is_active ? 'Hiển thị' : 'Ẩn' }}</td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route($editRoute, $category) }}" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">Sửa</a>
                                    <x-backend.confirm-delete-button :action="route($destroyRoute, $category)" title="Xóa danh mục" :message="'Bạn có chắc chắn muốn xóa danh mục '.$category->name.' không?'" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-slate-500">Chưa có danh mục.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $categories->links() }}</div>
    </x-backend.panel>
@endsection
