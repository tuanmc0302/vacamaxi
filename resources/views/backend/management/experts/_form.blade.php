@php
    $isEdit = $method !== 'POST';
    $image = $expert->image
        ? (str_starts_with($expert->image, 'http') ? $expert->image : asset('storage/'.$expert->image))
        : asset('image/logo.png');
@endphp

<div class="space-y-6">
    <x-backend.alert type="error" :message="$errors->first()" />

    <x-backend.panel>
        <x-backend.page-header kicker="Expert" :title="$title" :description="$description">
            <a href="{{ route('admin.experts.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Quay lại
            </a>
        </x-backend.page-header>

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="mt-8 grid gap-8 lg:grid-cols-[minmax(0,1fr),320px]">
            @csrf
            @if ($isEdit)
                @method($method)
            @endif

            <div class="space-y-6">
                <div class="grid gap-5 md:grid-cols-2">
                    <x-backend.form.input id="name" name="name" label="Họ và tên" :value="$expert->name" required placeholder="Nhập tên chuyên gia" />
                    <x-backend.form.input id="role" name="role" label="Vai trò / Chuyên môn" :value="$expert->role" placeholder="Ví dụ: Chuyên gia di truyền Argentina" />
                </div>

                <div>
                    <label for="description" class="mb-2 block text-sm font-medium text-slate-700">Giới thiệu ngắn</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        placeholder="Mô tả kinh nghiệm, chuyên môn..."
                        class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >{{ old('description', $expert->description) }}</textarea>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <x-backend.form.input id="sort_order" name="sort_order" label="Thứ tự hiển thị" type="number" :value="$expert->sort_order ?? 0" />

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <label class="flex items-start gap-3">
                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(old('is_active', $expert->is_active ?? true))
                                class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                            >
                            <span>
                                <span class="block text-sm font-semibold text-slate-800">Bật hiển thị</span>
                                <span class="mt-1 block text-xs text-slate-500">Chuyên gia được bật sẽ có thể xuất hiện ở frontend.</span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <aside class="space-y-5">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-semibold text-slate-800">Ảnh đại diện</p>
                    <div class="mt-4 overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200">
                        <img src="{{ $image }}" alt="{{ $expert->name ?: 'Ảnh chuyên gia' }}" class="h-56 w-full object-cover">
                    </div>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="mt-4 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none file:mr-4 file:rounded-lg file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white"
                    >
                    <p class="mt-2 text-xs text-slate-500">Dung lượng tối đa 2MB. Nên dùng ảnh vuông hoặc ảnh chân dung rõ mặt.</p>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.experts.index') }}" class="inline-flex h-12 items-center justify-center rounded-xl border border-slate-300 px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Hủy bỏ
                    </a>
                    <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
                        {{ $submitLabel }}
                    </button>
                </div>
            </aside>
        </form>
    </x-backend.panel>
</div>
