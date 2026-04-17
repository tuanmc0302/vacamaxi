<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | Xác minh 2FA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="flex min-h-screen items-center justify-center px-6 py-12">
        <section class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-blue-600">Xác thực hai lớp</p>
                <h1 class="mt-4 text-3xl font-bold text-slate-900">Nhập mã Google Authenticator</h1>
                <p class="mt-3 text-sm leading-7 text-slate-500">Tài khoản của bạn đã bật 2FA. Hãy nhập mã 6 số từ ứng dụng xác thực.</p>
            </div>

            @if ($errors->any())
                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.two-factor.verify') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="code" class="mb-2 block text-sm font-medium text-slate-700">Mã xác thực</label>
                    <input id="code" name="code" type="text" inputmode="numeric" autocomplete="one-time-code" autofocus required class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-center text-2xl tracking-[0.45em] text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>

                <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Xác minh
                </button>
            </form>
        </section>
    </div>
</body>
</html>
