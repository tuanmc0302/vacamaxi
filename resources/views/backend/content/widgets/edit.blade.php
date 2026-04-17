@extends('backend.layouts.app')

@section('title', 'Admin | Sửa widget trang chủ')
@section('eyebrow', 'Trang chủ')
@section('page_heading', 'Sửa widget trang chủ')

@section('content')
    <x-backend.panel class="mx-auto max-w-4xl">
        <x-backend.page-header kicker="{{ $widget->key }}" :title="$widget->title ?: 'Widget trang chủ'">
            <a href="{{ route('admin.widgets.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Quay lại</a>
        </x-backend.page-header>

        <x-backend.alert class="mt-6" type="error" :message="$errors->first()" />

        <form method="POST" action="{{ route('admin.widgets.update', $widget) }}" class="mt-8 space-y-5">
            @csrf
            @method('PUT')

            <x-backend.form.input id="title" name="title" label="Title" :value="$widget->title" />
            <x-backend.form.input id="sub_title" name="sub_title" label="Sub title" :value="$widget->sub_title" />

            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-slate-700">Description</label>
                <textarea id="description" name="description" rows="8" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description', $widget->description) }}</textarea>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <x-backend.form.input id="sort_order" name="sort_order" type="number" label="Thứ tự" :value="$widget->sort_order" />
                <label class="flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $widget->is_active)) class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Hiển thị widget
                </label>
            </div>

            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Cập nhật widget</button>
        </form>
    </x-backend.panel>
@endsection