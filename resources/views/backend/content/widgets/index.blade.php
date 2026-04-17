@extends('backend.layouts.app')

@section('title', 'Admin | Widget trang chủ')
@section('eyebrow', 'Trang chủ')
@section('page_heading', 'Cấu hình widget trang chủ')

@section('content')
    <x-backend.panel>
        <x-backend.alert class="mb-6" :message="session('status')" />
        <x-backend.page-header kicker="Widget" title="Danh sách widget trang chủ" description="Chỉnh sửa title, sub title và description cho từng section trên trang chủ." />

        <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Key</th>
                        <th class="px-5 py-4 font-semibold">Title</th>
                        <th class="px-5 py-4 font-semibold">Sub title</th>
                        <th class="px-5 py-4 font-semibold">Thứ tự</th>
                        <th class="px-5 py-4 font-semibold">Trạng thái</th>
                        <th class="px-5 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                    @foreach ($widgets as $widget)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4 font-mono text-xs text-slate-500">{{ $widget->key }}</td>
                            <td class="px-5 py-4 font-medium text-slate-900">{{ $widget->title }}</td>
                            <td class="px-5 py-4">{{ $widget->sub_title }}</td>
                            <td class="px-5 py-4">{{ $widget->sort_order }}</td>
                            <td class="px-5 py-4">{{ $widget->is_active ? 'Hiển thị' : 'Ẩn' }}</td>
                            <td class="px-5 py-4 text-right">
                                @if (auth()->user()?->hasPermission('admin.widgets.edit'))
                                    <a href="{{ route('admin.widgets.edit', $widget) }}" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">Sửa</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-backend.panel>
@endsection