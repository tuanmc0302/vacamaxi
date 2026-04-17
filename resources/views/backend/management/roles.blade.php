@extends('backend.layouts.app')

@section('title', 'Admin | Danh sách vai trò')
@section('eyebrow', 'Phân quyền')
@section('page_heading', 'Danh sách vai trò')

@section('content')
    <x-backend.panel>
        <x-backend.alert class="mb-6" :message="session('status')" />
        <x-backend.alert class="mb-6" type="error" :message="$errors->first()" />

        <x-backend.page-header kicker="Vai trò hiện có" title="Danh sách vai trò">
            @if (auth()->user()?->hasPermission('admin.roles.create'))
                <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Thêm mới vai trò</a>
            @endif
        </x-backend.page-header>

        <form method="GET" action="{{ route('admin.roles.index') }}" class="mt-8 grid gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5 md:grid-cols-[minmax(0,1fr),auto]">
            <x-backend.form.input id="keyword" name="keyword" label="Tìm kiếm" :value="$filters['keyword']" placeholder="Nhập tên hiển thị hoặc mã vai trò" />

            <div class="flex items-end gap-3">
                <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-slate-900 px-5 text-sm font-semibold text-white transition hover:bg-slate-700">Áp dụng</button>
                <a href="{{ route('admin.roles.index') }}" class="inline-flex h-12 items-center justify-center rounded-xl border border-slate-300 px-5 text-sm font-medium text-slate-700 transition hover:bg-white">Xóa lọc</a>
            </div>
        </form>

        <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Tên hiển thị</th>
                        <th class="px-5 py-4 font-semibold">Mã vai trò</th>
                        <th class="px-5 py-4 font-semibold">Số quyền</th>
                        <th class="px-5 py-4 font-semibold">Quyền đã gán</th>
                        <th class="px-5 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                    @forelse ($roles as $role)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4 font-medium text-slate-900">{{ $role->title }}</td>
                            <td class="px-5 py-4">{{ $role->name }}</td>
                            <td class="px-5 py-4">{{ $role->permissions->count() }}</td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($role->permissions as $permission)
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">{{ $permission->title }}</span>
                                    @empty
                                        <span class="text-slate-500">Chưa gán quyền</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if (auth()->user()?->hasPermission('admin.roles.create'))
                                        <a href="{{ route('admin.roles.edit', $role) }}" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">Sửa vai trò</a>
                                    @endif

                                    @if (auth()->user()?->hasPermission('admin.roles.delete') && $role->name !== 'super_admin')
                                        <x-backend.confirm-delete-button :action="route('admin.roles.destroy', $role)" title="Xóa vai trò" :message="'Bạn có chắc chắn muốn xóa vai trò '.$role->title.' không?'" />
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-slate-500">Chưa có vai trò nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-backend.panel>
@endsection
