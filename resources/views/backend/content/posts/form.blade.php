@extends('backend.layouts.app')

@php($isEdit = $post->exists)

@section('title', ($isEdit ? 'Sửa bài viết' : 'Thêm bài viết') . ' | Admin')
@section('eyebrow', 'Quản trị nội dung')
@section('page_heading', $isEdit ? 'Sửa bài viết' : 'Thêm bài viết')

@section('content')
    <form method="POST" action="{{ $isEdit ? route('admin.posts.update', $post) : route('admin.posts.store') }}" class="space-y-6">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tiêu đề</label>
                    <input name="title" value="{{ old('title', $post->title) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50" required>
                    @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Slug</label>
                    <input name="slug" value="{{ old('slug', $post->slug) }}" placeholder="Tự tạo nếu để trống" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Danh mục bài viết</label>
                    <select name="category_id" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                        <option value="">Chưa chọn</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('category_id', $post->category_id) === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Ảnh</label>
                    <input name="image" value="{{ old('image', $post->image) }}" placeholder="assets/images/Rectangle 2.png" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('image') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Ngày đăng</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('published_at') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <label class="flex items-center gap-3 self-end rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $post->is_active)) class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Hiển thị
                </label>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-5">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả ngắn</label>
                    <textarea name="description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('description', $post->description) }}</textarea>
                    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nội dung</label>
                    <textarea id="content" name="content" rows="12" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('content', $post->content) }}</textarea>
                    @error('content') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900">SEO</h2>
            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO title</label>
                    <input name="seo_title" value="{{ old('seo_title', $post->seo_title) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('seo_title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO description</label>
                    <textarea name="seo_description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('seo_description', $post->seo_description) }}</textarea>
                    @error('seo_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.posts.index') }}" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">Quay lại</a>
            <button type="submit" class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Lưu bài viết</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editor = document.querySelector('#content');
            if (editor && window.ClassicEditor) {
                ClassicEditor.create(editor).catch(function (error) {
                    console.error(error);
                });
            }
        });
    </script>
@endpush
