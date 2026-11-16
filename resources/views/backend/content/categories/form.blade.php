@extends('backend.layouts.app')

@php
    $isNews = $module === 'news';
    $isEdit = $category->exists;
    $indexRoute = $isNews ? 'admin.news-categories.index' : 'admin.product-categories.index';
    $storeRoute = $isNews ? 'admin.news-categories.store' : 'admin.product-categories.store';
    $updateRoute = $isNews ? 'admin.news-categories.update' : 'admin.product-categories.update';
    $heading = ($isEdit ? 'Sửa ' : 'Thêm ').($isNews ? 'danh mục bài viết' : 'danh mục sản phẩm');
@endphp

@section('title', 'Admin | '.$heading)
@section('eyebrow', 'Danh mục')
@section('page_heading', $heading)

@section('content')
    <x-backend.panel class="mx-auto max-w-3xl">
        <x-backend.page-header kicker="{{ $isNews ? 'News' : 'Product' }}" :title="$heading">
            <a href="{{ route($indexRoute) }}" class="inline-flex items-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Xem danh sách</a>
        </x-backend.page-header>
        <x-backend.alert class="mt-6" type="error" :message="$errors->first()" />

        <form method="POST" action="{{ $isEdit ? route($updateRoute, $category) : route($storeRoute) }}" class="mt-8 space-y-5">
            @csrf
            @if($isEdit) @method('PUT') @endif
            <div>
                <label for="parent_id" class="mb-2 block text-sm font-medium text-slate-700">Danh mục cha</label>
                <select id="parent_id" name="parent_id" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="">-- Là danh mục gốc (không có cha) --</option>
                    @if(isset($parentCategories))
                        @foreach ($parentCategories as $parent)
                            <option value="{{ $parent->id }}" @selected((string) old('parent_id', $category->parent_id) === (string) $parent->id)>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('parent_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <x-backend.form.input id="name" name="name" label="Tên danh mục (VI)" :value="$category->name" required />
            <x-backend.form.input id="name_en" name="name_en" label="Tên danh mục (EN)" :value="$category->name_en" />
            <x-backend.form.input id="slug" name="slug" label="Slug" :value="$category->slug" placeholder="Tự sinh nếu để trống" />
            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-slate-700">Mô tả (VI)</label>
                <textarea id="description" name="description" rows="3" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description', $category->description) }}</textarea>
            </div>
            <div>
                <label for="description_en" class="mb-2 block text-sm font-medium text-slate-700">Mô tả (EN)</label>
                <textarea id="description_en" name="description_en" rows="3" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description_en', $category->description_en) }}</textarea>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <x-backend.form.input id="sort_order" name="sort_order" type="number" label="Thứ tự" :value="$category->sort_order" />
                <label class="flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active)) class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Hiển thị
                </label>
            </div>
            @if(! $isNews)
                <div class="rounded-xl border border-amber-200 bg-amber-50/60 p-4">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="hidden" name="is_18_plus" value="0">
                        <input type="checkbox" name="is_18_plus" value="1" @checked(old('is_18_plus', $category->is_18_plus)) class="mt-0.5 h-4 w-4 rounded border-amber-300 text-amber-600 focus:ring-amber-500">
                        <div>
                            <span class="block text-sm font-semibold text-slate-800">Dành cho người từ đủ 18 tuổi trở lên (18+)</span>
                            <span class="block text-xs text-slate-500 mt-0.5">Bật tính năng này sẽ hiển thị popup yêu cầu xác minh độ tuổi 18+ khi người dùng truy cập danh mục này và các sản phẩm thuộc danh mục.</span>
                        </div>
                    </label>
                </div>
            @endif
            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">{{ $isEdit ? 'Cập nhật' : 'Tạo mới' }}</button>
        </form>
    </x-backend.panel>
@endsection