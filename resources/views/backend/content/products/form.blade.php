@extends('backend.layouts.app')

@php($isEdit = $product->exists)

@section('title', ($isEdit ? 'Sửa sản phẩm' : 'Thêm sản phẩm') . ' | Admin')
@section('eyebrow', 'Quản trị nội dung')
@section('page_heading', $isEdit ? 'Sửa sản phẩm' : 'Thêm sản phẩm')

@section('content')
    <form method="POST" action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tên sản phẩm (VI)</label>
                    <input name="name" value="{{ old('name', $product->name) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50" required>
                    @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tên sản phẩm (EN)</label>
                    <input name="name_en" value="{{ old('name_en', $product->name_en) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('name_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
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
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Upload ảnh</label>
                    <input type="file" name="image_file" accept="image/*" class="block h-12 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-slate-900 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('image_file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    @if ($product->image)
                        <div class="mt-3 flex items-center gap-3 text-xs text-slate-500">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="h-14 w-20 rounded-lg object-cover">
                            <span>Ảnh hiện tại: {{ $product->image }}</span>
                        </div>
                    @endif
                </div>
                <div class="md:col-span-2 rounded-xl border border-slate-200 bg-slate-50/60 p-4">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Upload ảnh phụ (Gallery - chọn nhiều ảnh cùng lúc)</label>
                    <input type="file" id="gallery_files_input" name="gallery_files[]" accept="image/*" multiple class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    <p class="mt-1 text-xs text-slate-500">Giữ phím Ctrl (hoặc Shift) để chọn nhiều ảnh cùng một lúc.</p>
                    @error('gallery_files.*') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror

                    {{-- Vùng xem trước ảnh mới chọn --}}
                    <div id="new_gallery_preview_wrapper" class="mt-4 hidden border-t border-slate-200 pt-3">
                        <p class="text-xs font-semibold text-blue-700 mb-2">Ảnh mới chọn xem trước:</p>
                        <div id="new_gallery_preview" class="flex flex-wrap gap-3"></div>
                    </div>

                    {{-- Vùng ảnh phụ hiện tại --}}
                    @if (!empty($product->gallery) && is_array($product->gallery))
                        <div class="mt-4 border-t border-slate-200 pt-3">
                            <p class="text-xs font-semibold text-slate-700 mb-2">Ảnh phụ hiện tại (bấm nút đỏ trên góc ảnh để xóa):</p>
                            <div class="flex flex-wrap gap-3" id="existing_gallery_container">
                                @foreach ($product->gallery as $idx => $galleryImage)
                                    <div class="relative group rounded-lg overflow-hidden border border-slate-200 bg-white shadow-sm" id="gallery_item_{{ $idx }}">
                                        <img src="{{ asset($galleryImage) }}" alt="Gallery" class="h-20 w-24 object-cover">
                                        <input type="hidden" name="existing_gallery[]" value="{{ $galleryImage }}">
                                        <button type="button" onclick="removeExistingGalleryImage('gallery_item_{{ $idx }}')" class="absolute top-1 right-1 h-6 w-6 rounded-full bg-red-600 text-white flex items-center justify-center opacity-85 hover:opacity-100 transition shadow" title="Xóa ảnh này">
                                            <i class="bi bi-x text-base font-bold"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
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
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả ngắn (VI)</label>
                    <textarea name="short_description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('short_description', $product->short_description) }}</textarea>
                    @error('short_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả ngắn (EN)</label>
                    <textarea name="short_description_en" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('short_description_en', $product->short_description_en) }}</textarea>
                    @error('short_description_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả sản phẩm (VI)</label>
                    <textarea name="description" rows="8" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả sản phẩm (EN)</label>
                    <textarea name="description_en" rows="8" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('description_en', $product->description_en) }}</textarea>
                    @error('description_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900">SEO</h2>
            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO title (VI)</label>
                    <input name="seo_title" value="{{ old('seo_title', $product->seo_title) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('seo_title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO title (EN)</label>
                    <input name="seo_title_en" value="{{ old('seo_title_en', $product->seo_title_en) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('seo_title_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO description (VI)</label>
                    <textarea name="seo_description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('seo_description', $product->seo_description) }}</textarea>
                    @error('seo_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO description (EN)</label>
                    <textarea name="seo_description_en" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('seo_description_en', $product->seo_description_en) }}</textarea>
                    @error('seo_description_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">Quay lại</a>
            <button type="submit" class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Lưu sản phẩm</button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('gallery_files_input');
        const previewWrapper = document.getElementById('new_gallery_preview_wrapper');
        const previewContainer = document.getElementById('new_gallery_preview');

        if (input && previewContainer) {
            input.addEventListener('change', function(e) {
                previewContainer.innerHTML = '';
                const files = Array.from(e.target.files);

                if (files.length > 0) {
                    previewWrapper.classList.remove('hidden');
                    files.forEach(function(file) {
                        if (!file.type.startsWith('image/')) return;

                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const item = document.createElement('div');
                            item.className = 'relative rounded-lg overflow-hidden border border-blue-300 bg-white shadow-sm';
                            item.innerHTML = `
                                <img src="${event.target.result}" alt="${file.name}" class="h-20 w-24 object-cover">
                                <span class="absolute bottom-0 left-0 right-0 bg-slate-900/70 text-white text-[10px] px-1 py-0.5 truncate text-center block" title="${file.name}">${file.name}</span>
                            `;
                            previewContainer.appendChild(item);
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    previewWrapper.classList.add('hidden');
                }
            });
        }
    });

    function removeExistingGalleryImage(itemId) {
        const item = document.getElementById(itemId);
        if (item) {
            item.remove();
        }
    }
</script>
@endpush