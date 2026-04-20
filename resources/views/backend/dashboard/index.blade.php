@extends('backend.layouts.app')

@section('title', 'Admin | Bảng điều khiển')
@section('eyebrow', 'Tổng quan')
@section('page_heading', 'Bảng điều khiển')

@section('content')
    <div class="space-y-6">
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-6 px-8 py-8 lg:grid-cols-[1.3fr_0.7fr]">
                <div>
                    <div class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-blue-700">
                        Quản trị hệ thống
                    </div>
                    <h2 class="mt-5 text-3xl font-bold tracking-tight text-slate-900">
                        Xin chào, {{ $currentUser?->full_name ?: $currentUser?->username }}.
                    </h2>
                    <p class="mt-4 max-w-3xl text-base leading-8 text-slate-600">
                        Đây là khu vực điều hành backend. Bạn có thể quản lý người dùng, vai trò, quyền truy cập và bảo mật tài khoản từ các mục ở thanh điều hướng bên trái.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                            Quản lý người dùng
                        </a>

                        <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Quản lý vai trò
                        </a>

                        <a href="{{ route('admin.two-factor.settings') }}" class="inline-flex items-center rounded-xl border border-blue-200 bg-blue-50 px-5 py-3 text-sm font-semibold text-blue-700 transition hover:bg-blue-100">
                            Cấu hình Google 2FA
                        </a>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Tài khoản hiện tại</p>

                    <dl class="mt-6 space-y-5">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Họ và tên</dt>
                            <dd class="mt-2 text-lg font-semibold text-slate-900">{{ $currentUser?->full_name ?: 'Chưa cập nhật' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Tên đăng nhập</dt>
                            <dd class="mt-2 text-lg font-semibold text-slate-900">{{ $currentUser?->username }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Vai trò</dt>
                            <dd class="mt-2 text-base font-semibold text-blue-700">{{ $currentUser?->roles->pluck('title')->join(', ') ?: 'Chưa gán vai trò' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Trạng thái bảo mật</dt>
                            <dd class="mt-2">
                                @if ($currentUser?->isTwoFactorEnabled())
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700">Đã bật Google 2FA</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-sm font-semibold text-amber-700">Chưa bật Google 2FA</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($overviewCards as $card)
                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">{{ $card['label'] }}</p>
                    <p class="mt-4 text-3xl font-bold text-slate-900">{{ $card['value'] }}</p>
                    <p class="mt-3 text-sm leading-6 text-slate-500">{{ $card['description'] }}</p>
                </article>
            @endforeach
        </section>
    </div>
@endsection
