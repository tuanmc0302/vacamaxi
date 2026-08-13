@extends('backend.layouts.app')

@section('title', 'Admin | Quản lý bình luận')
@section('eyebrow', 'Hệ thống')
@section('page_heading', 'Danh sách bình luận')

@section('content')
    <x-backend.panel>
        <x-backend.alert class="mb-6" :message="session('status')" />

        <div class="overflow-hidden rounded-2xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Người gửi</th>
                        <th class="px-5 py-4 font-semibold">Bài viết</th>
                        <th class="px-5 py-4 font-semibold">Nội dung</th>
                        <th class="px-5 py-4 font-semibold">Ngày gửi</th>
                        <th class="px-5 py-4 font-semibold">Trạng thái</th>
                        <th class="px-5 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                    @forelse ($comments as $comment)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4">
                                <div class="text-slate-900 font-bold">{{ $comment->full_name }}</div>
                                <div class="text-xs text-slate-500">{{ $comment->email }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="max-w-xs truncate" title="{{ $comment->post?->title }}">
                                    <a href="{{ route('frontend.news.show', ['slug' => $comment->post?->slug ?? '']) }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ $comment->post?->title }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="max-w-xs" title="{{ $comment->content }}">
                                    {{ $comment->content }}
                                </div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                {{ $comment->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-5 py-4">
                                @if($comment->is_approved)
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">Đã duyệt</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-700">Chờ duyệt</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <form action="{{ route('admin.comments.toggle-approval', $comment) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                                            {{ $comment->is_approved ? 'Ẩn' : 'Duyệt' }}
                                        </button>
                                    </form>
                                    <x-backend.confirm-delete-button 
                                        :action="route('admin.comments.destroy', $comment)" 
                                        title="Xóa bình luận" 
                                        :message="'Bạn có chắc chắn muốn xóa bình luận từ '.$comment->full_name.' không?'" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-slate-500">Chưa có bình luận nào.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $comments->links() }}</div>
    </x-backend.panel>
@endsection
