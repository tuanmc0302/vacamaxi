@extends('backend.layouts.app')

@section('title', 'Admin | Quản lý liên hệ')
@section('eyebrow', 'Hệ thống')
@section('page_heading', 'Danh sách liên hệ')

@section('content')
    <x-backend.panel>
        <x-backend.alert class="mb-6" :message="session('status')" />

        <div class="overflow-hidden rounded-2xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Khách hàng</th>
                        <th class="px-5 py-4 font-semibold">Thông tin</th>
                        <th class="px-5 py-4 font-semibold">Nội dung</th>
                        <th class="px-5 py-4 font-semibold">Ngày gửi</th>
                        <th class="px-5 py-4 font-semibold">Trạng thái</th>
                        <th class="px-5 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                    @forelse ($contacts as $contact)
                        <tr class="hover:bg-slate-50 {{ $contact->is_read ? 'opacity-60' : 'font-medium' }}">
                            <td class="px-5 py-4">
                                <div class="text-slate-900 font-bold">{{ $contact->full_name }}</div>
                                <div class="text-xs text-slate-500">{{ $contact->email }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <div>SĐT: {{ $contact->phone }}</div>
                                @if($contact->title)
                                    <div class="text-xs text-slate-500">TĐ: {{ $contact->title }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="max-w-xs truncate" title="{{ $contact->content }}">
                                    {{ $contact->content }}
                                </div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                {{ $contact->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-5 py-4">
                                @if($contact->is_read)
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">Đã đọc</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700">Mới</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if(!$contact->is_read)
                                        <form action="{{ route('admin.contacts.mark-read', $contact) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">Đã đọc</button>
                                        </form>
                                    @endif
                                    <x-backend.confirm-delete-button 
                                        :action="route('admin.contacts.destroy', $contact)" 
                                        title="Xóa liên hệ" 
                                        :message="'Bạn có chắc chắn muốn xóa liên hệ từ '.$contact->full_name.' không?'" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-slate-500">Chưa có liên hệ nào.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $contacts->links() }}</div>
    </x-backend.panel>
@endsection
