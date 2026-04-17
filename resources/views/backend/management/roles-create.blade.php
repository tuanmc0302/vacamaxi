@extends('backend.layouts.app')

@section('title', 'Admin | Thêm mới vai trò')
@section('eyebrow', 'Phân quyền')
@section('page_heading', 'Thêm mới vai trò')

@section('content')
    <x-backend.panel class="mx-auto max-w-3xl">
        <x-backend.page-header kicker="Tạo mới" title="Thêm vai trò">
            <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                Xem danh sách
            </a>
        </x-backend.page-header>

        <x-backend.alert class="mt-6" type="error" :message="$errors->first()" />

        <form method="POST" action="{{ route('admin.roles.store') }}" class="mt-8 space-y-5">
            @csrf

            <x-backend.form.input id="title" name="title" label="Tên hiển thị" required />
            <x-backend.form.input id="name" name="name" label="Mã vai trò" required />

            <x-backend.form.select
                id="permission_ids"
                name="permission_ids[]"
                label="Quyền của vai trò"
                :multiple="true"
                placeholder="Chọn quyền cho vai trò"
            >
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}" @selected(collect(old('permission_ids', []))->contains($permission->id))>{{ $permission->title }}</option>
                @endforeach
            </x-backend.form.select>

            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                Tạo vai trò
            </button>
        </form>
    </x-backend.panel>
@endsection
