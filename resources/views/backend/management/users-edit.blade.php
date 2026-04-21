@extends('backend.layouts.app')

@section('title', 'Admin | Sửa người dùng')
@section('eyebrow', 'Người dùng')
@section('page_heading', 'Sửa người dùng')

@section('content')
    <x-backend.panel class="mx-auto max-w-3xl">
        <x-backend.page-header kicker="Chỉnh sửa" :title="$user->full_name">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                Xem danh sách
            </a>
        </x-backend.page-header>

        <x-backend.alert class="mt-6" type="error" :message="$errors->first()" />

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-8 space-y-5">
            @csrf
            @method('PUT')

            <x-backend.form.input id="full_name" name="full_name" label="Họ và tên" :value="$user->full_name" required />

            <div class="grid gap-5 md:grid-cols-2">
                <x-backend.form.input id="username" name="username" label="Tên đăng nhập" :value="$user->username" required />
                <x-backend.form.input id="email" name="email" type="email" label="Email" :value="$user->email" required />
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <x-backend.form.input id="password" name="password" type="password" label="Mật khẩu mới" hint="Để trống nếu không muốn thay đổi." />
                <x-backend.form.input id="password_confirmation" name="password_confirmation" type="password" label="Xác nhận mật khẩu mới" />
            </div>

            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                Cập nhật người dùng
            </button>
        </form>
    </x-backend.panel>
@endsection
