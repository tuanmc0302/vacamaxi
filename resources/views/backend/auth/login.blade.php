<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | Đăng nhập quản trị</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="flex min-h-screen items-center justify-center px-6 py-12">
        <section class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-blue-600">Quản trị hệ thống</p>
                <h1 class="mt-4 text-3xl font-bold text-slate-900">Đăng nhập quản trị</h1>
                <p class="mt-3 text-sm leading-7 text-slate-500">
                    Nhập tên đăng nhập và mật khẩu để truy cập trang quản trị.
                </p>
            </div>

            @if ($errors->any())
                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="username" class="mb-2 block text-sm font-medium text-slate-700">Tên đăng nhập</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        value="{{ old('username') }}"
                        required
                        autofocus
                        class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Nhập tên đăng nhập"
                    >
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Mật khẩu</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Nhập mật khẩu"
                    >
                </div>

                <label class="flex items-center gap-3 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1" @checked(old('remember')) class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Ghi nhớ đăng nhập
                </label>

                <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Đăng nhập
                </button>
            </form>
        </section>
    </div>
</body>
</html>
