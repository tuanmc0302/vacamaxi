@extends('backend.layouts.app')

@section('title', 'Bảo mật 2FA')
@section('eyebrow', 'Bảo mật')
@section('page_heading', 'Google 2FA')

@section('content')
    <div class="grid gap-6 lg:grid-cols-[1fr_0.9fr]">
        <section class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
            <p class="text-sm font-medium uppercase tracking-[0.2em] text-slate-500">Cấu hình</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900">Bật hoặc tắt Google 2FA</h2>
            <p class="mt-4 leading-8 text-slate-600">
                Dùng ứng dụng Google Authenticator hoặc ứng dụng hỗ trợ TOTP tương thích. Khi 2FA được bật, backend sẽ yêu cầu nhập mã xác thực sau bước đăng nhập.
            </p>

            @if (session('status'))
                <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mt-8 rounded-xl border border-slate-200 bg-slate-50 p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Trạng thái</p>
                <p class="mt-3 text-lg font-semibold {{ auth()->user()?->isTwoFactorEnabled() ? 'text-emerald-700' : 'text-amber-700' }}">
                    {{ auth()->user()?->isTwoFactorEnabled() ? 'Đang bật Google 2FA' : 'Chưa bật Google 2FA' }}
                </p>
            </div>

            @if (! auth()->user()?->isTwoFactorEnabled())
                <form method="POST" action="{{ route('admin.two-factor.enable') }}" class="mt-8 space-y-5">
                    @csrf

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Quét mã QR</p>
                        <div class="mt-4 flex justify-center">
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <img src="{{ $qrCodeUrl }}" alt="QR Google 2FA" class="h-56 w-56 rounded-xl">
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-slate-600">
                            Mở Google Authenticator, chọn thêm tài khoản mới và quét mã QR này.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Mã bí mật</p>
                        <p class="mt-3 break-all font-mono text-lg text-slate-900">{{ $secret }}</p>
                        <p class="mt-3 text-sm text-slate-600">Nếu ứng dụng không quét QR, bạn có thể nhập thủ công mã bí mật này.</p>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">OTP Auth URI</p>
                        <p class="mt-3 break-all font-mono text-sm text-slate-700">{{ $otpAuthUrl }}</p>
                    </div>

                    <div>
                        <label for="code" class="mb-2 block text-sm font-medium text-slate-700">Nhập mã 6 số để xác nhận bật 2FA</label>
                        <input id="code" name="code" type="text" inputmode="numeric" required class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Bật Google 2FA
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.two-factor.disable') }}" class="mt-8">
                    @csrf
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl border border-red-300 bg-red-50 px-5 py-3 text-sm font-semibold text-red-700 transition hover:bg-red-100">
                        Tắt Google 2FA
                    </button>
                </form>
            @endif
        </section>
    </div>
@endsection
