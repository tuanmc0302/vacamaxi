@extends('backend.layouts.app')

@section('title', 'Chuyên gia | Admin')
@section('eyebrow', 'Quản trị nội dung')
@section('page_heading', 'Chuyên gia')

@section('content')
    <div class="space-y-6">
        <x-backend.alert :message="session('status') ?: session('success')" />
        <x-backend.alert type="error" :message="$errors->first()" />

        <x-backend.panel>
            <x-backend.page-header
                kicker="Experts"
                title="Danh sách chuyên gia"
                description="Quản lý đội ngũ chuyên gia hiển thị trên các trang giới thiệu và quy mô."
            >
                <a href="{{ route('admin.experts.create') }}" class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Thêm chuyên gia
                </a>
            </x-backend.page-header>

            <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-4">Chuyên gia</th>
                            <th class="px-5 py-4">Vai trò / Chuyên môn</th>
                            <th class="px-5 py-4">Thứ tự</th>
                            <th class="px-5 py-4">Trạng thái</th>
                            <th class="px-5 py-4 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                        @forelse ($experts as $expert)
                            @php
                                $image = $expert->image
                                    ? (str_starts_with($expert->image, 'http') ? $expert->image : asset('storage/'.$expert->image))
                                    : asset('image/logo.png');
                            @endphp
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-16 w-16 overflow-hidden rounded-2xl bg-slate-100 ring-1 ring-slate-200">
                                            <img src="{{ $image }}" alt="{{ $expert->name }}" class="h-full w-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $expert->name }}</p>
                                            <p class="mt-1 line-clamp-1 max-w-md text-xs text-slate-500">{{ $expert->description ?: 'Chưa có mô tả.' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-slate-600">{{ $expert->role ?: '-' }}</td>
                                <td class="px-5 py-4 text-slate-600">{{ $expert->sort_order }}</td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $expert->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $expert->is_active ? 'Đang bật' : 'Đang tắt' }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('admin.experts.edit', $expert) }}" class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                            Sửa
                                        </a>
                                        <x-backend.confirm-delete-button
                                            :action="route('admin.experts.destroy', $expert)"
                                            title="Xóa chuyên gia"
                                            :message="'Bạn có chắc chắn muốn xóa chuyên gia '.$expert->name.' không?'"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center text-slate-500">
                                    Chưa có chuyên gia nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $experts->links() }}
            </div>
        </x-backend.panel>
    </div>
@endsection
