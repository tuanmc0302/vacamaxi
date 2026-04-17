@extends('backend.layouts.app')

@php($isEdit = $product->exists)

@section('title', ($isEdit ? 'Sửa sản phẩm' : 'Thêm sản phẩm') . ' | Admin')
@section('eyebrow', 'Quản trị nội dung')
@section('page_heading', $isEdit ? 'Sửa sản phẩm' : 'Thêm sản phẩm')

@section('content')
    <form method="POST" action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}" class="space-y-6">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tên sản phẩm</label>
                    <input name="name" value="{{ old('name', $product->name) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50" required>
                    @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Slug</label>
                    <input name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Tự tạo nếu để trống" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Danh mục</label>
                    <select name="category_id" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                        <option value="">Chưa chọn</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id) === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Ảnh</label>
                    <input name="image" value="{{ old('image', $product->image) }}" placeholder="assets/images/Rectangle 2.png" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('image') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Thứ tự</label>
                    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('sort_order') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <label class="flex items-center gap-3 self-end rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active)) class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Hiển thị
                </label>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-5">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả ngắn</label>
                    <textarea name="short_description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('short_description', $product->short_description) }}</textarea>
                    @error('short_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả sản phẩm</label>
                    <textarea name="description" rows="8" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900">SEO</h2>
            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO title</label>
                    <input name="seo_title" value="{{ old('seo_title', $product->seo_title) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('seo_title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO description</label>
                    <textarea name="seo_description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('seo_description', $product->seo_description) }}</textarea>
                    @error('seo_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">Quay lại</a>
            <button type="submit" class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Lưu sản phẩm</button>
        </div>
    </form>
@endsection
