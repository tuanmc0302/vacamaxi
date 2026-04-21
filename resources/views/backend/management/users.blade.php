@extends('backend.layouts.app')

@section('title', 'Admin | Danh sách người dùng')
@section('eyebrow', 'Người dùng')
@section('page_heading', 'Danh sách người dùng')

@section('content')
    <x-backend.panel>
        <x-backend.alert class="mb-6" :message="session('status')" />
        <x-backend.alert class="mb-6" type="error" :message="$errors->first()" />

        <x-backend.page-header kicker="Danh sách hệ thống" title="Tài khoản backend">
            <div class="rounded-xl bg-slate-100 px-4 py-3 text-sm text-slate-600">
                Tổng số: <span class="font-semibold text-slate-900">{{ $users->total() }}</span>
            </div>

            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                Thêm mới
            </a>
        </x-backend.page-header>

        <form method="GET" action="{{ route('admin.users.index') }}" class="mt-8 grid gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5 md:grid-cols-[minmax(0,1fr),auto]">
            <x-backend.form.input id="keyword" name="keyword" label="Tìm kiếm" :value="$filters['keyword']" placeholder="Nhập họ tên, tên đăng nhập hoặc email" />

            <div class="flex items-end gap-3">
                <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-slate-900 px-5 text-sm font-semibold text-white transition hover:bg-slate-700">Áp dụng</button>
                <a href="{{ route('admin.users.index') }}" class="inline-flex h-12 items-center justify-center rounded-xl border border-slate-300 px-5 text-sm font-medium text-slate-700 transition hover:bg-white">Xóa lọc</a>
            </div>
        </form>

        <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Họ và tên</th>
                        <th class="px-5 py-4 font-semibold">Tên đăng nhập</th>
                        <th class="px-5 py-4 font-semibold">Email</th>
                        <th class="px-5 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4 font-medium text-slate-900">{{ $user->full_name }}</td>
                            <td class="px-5 py-4">{{ $user->username }}</td>
                            <td class="px-5 py-4">{{ $user->email }}</td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">Sửa</a>

                                    <x-backend.confirm-delete-button :action="route('admin.users.destroy', $user)" title="Xóa người dùng" :message="'Bạn có chắc chắn muốn xóa tài khoản '.$user->username.' không?'" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-slate-500">Chưa có người dùng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-col gap-4 border-t border-slate-200 pt-6 md:flex-row md:items-center md:justify-between">
            <p class="text-sm text-slate-500">
                Hiển thị
                <span class="font-semibold text-slate-900">{{ $users->firstItem() ?? 0 }}</span>
                -
                <span class="font-semibold text-slate-900">{{ $users->lastItem() ?? 0 }}</span>
                trên tổng
                <span class="font-semibold text-slate-900">{{ $users->total() }}</span>
                người dùng
            </p>

            <div>{{ $users->links() }}</div>
        </div>
    </x-backend.panel>
@endsection
