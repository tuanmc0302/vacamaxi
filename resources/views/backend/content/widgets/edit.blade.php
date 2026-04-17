@extends('backend.layouts.app')

@section('title', 'Admin | Sửa widget trang chủ')
@section('eyebrow', 'Trang chủ')
@section('page_heading', 'Sửa widget trang chủ')

@section('content')
    @php
        $isProductOption = str($widget->key)->startsWith('product_option_');
        $isFeedbackWidget = $widget->key === 'feedback_home';
        $selectedCategoryId = old('category_id', data_get($widget->settings, 'category_id'));
        $defaultFeedbackItems = [
            [
                'avatar' => '/image/Rectangle 2.png',
                'role' => 'Khách hàng',
                'name' => 'Hoàng Trang',
                'content' => 'Thịt bò Vaca Maxi thật sự chất lượng. Bò mềm, tươi và được nêm nếm rất vừa miệng.',
            ],
            [
                'avatar' => '/image/Rectangle 3.png',
                'role' => 'Khách hàng',
                'name' => 'Tùng Phan',
                'content' => 'Đúng chuẩn quán bò cho người mê thịt. Không gian đẹp, nhân viên thân thiện, tư vấn món rất có tâm.',
            ],
        ];
        $feedbackItems = collect(old('feedback_items', data_get($widget->settings, 'items', $defaultFeedbackItems)))
            ->take(10)
            ->values();
    @endphp

    <x-backend.panel class="mx-auto max-w-4xl">
        <x-backend.page-header kicker="{{ $widget->key }}" :title="$widget->title ?: 'Widget trang chủ'">
            <a href="{{ route('admin.widgets.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Quay lại</a>
        </x-backend.page-header>

        <x-backend.alert class="mt-6" type="error" :message="$errors->first()" />

        <form method="POST" action="{{ route('admin.widgets.update', $widget) }}" class="mt-8 space-y-5">
            @csrf
            @method('PUT')

            <x-backend.form.input id="title" name="title" label="Title" :value="$widget->title" />
            <x-backend.form.input id="sub_title" name="sub_title" label="Sub title" :value="$widget->sub_title" />

            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-slate-700">Description</label>
                <textarea id="description" name="description" rows="8" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description', $widget->description) }}</textarea>
            </div>

            @if ($isProductOption)
                <div>
                    <label for="category_id" class="mb-2 block text-sm font-medium text-slate-700">Danh mục sản phẩm hiển thị</label>
                    <select id="category_id" name="category_id" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <option value="">Dùng dữ liệu mặc định</option>
                        @foreach ($productCategories as $category)
                            <option value="{{ $category->id }}" @selected((string) $selectedCategoryId === (string) $category->id)>
                                {{ $category->name }} ({{ $category->products_count }} sản phẩm)
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-xs text-slate-500">Widget sẽ lấy 4 sản phẩm mới nhất thuộc danh mục được chọn.</p>
                </div>
            @endif

            @if ($isFeedbackWidget)
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <h3 class="text-base font-semibold text-slate-900">Danh sách feedback</h3>
                            <p class="mt-1 text-sm text-slate-500">Frontend sẽ chạy dạng slide, tối đa 10 feedback.</p>
                        </div>
                        <button type="button" id="add-feedback-item" class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Thêm feedback</button>
                    </div>

                    <div id="feedback-items" class="mt-5 space-y-4">
                        @foreach ($feedbackItems as $index => $item)
                            <div class="feedback-item rounded-xl border border-slate-200 bg-white p-4" data-feedback-item>
                                <div class="mb-4 flex items-center justify-between gap-3">
                                    <p class="text-sm font-semibold text-slate-700">Feedback #{{ $index + 1 }}</p>
                                    <button type="button" class="text-sm font-medium text-red-600 hover:text-red-700" data-remove-feedback>Xóa</button>
                                </div>
                                <div class="grid gap-4 md:grid-cols-2">
                                    <x-backend.form.input id="feedback_avatar_{{ $index }}" name="feedback_items[{{ $index }}][avatar]" label="Avatar" :value="data_get($item, 'avatar')" />
                                    <x-backend.form.input id="feedback_role_{{ $index }}" name="feedback_items[{{ $index }}][role]" label="Vai trò" :value="data_get($item, 'role')" />
                                    <x-backend.form.input id="feedback_name_{{ $index }}" name="feedback_items[{{ $index }}][name]" label="Tên khách hàng" :value="data_get($item, 'name')" />
                                </div>
                                <div class="mt-4">
                                    <label for="feedback_content_{{ $index }}" class="mb-2 block text-sm font-medium text-slate-700">Nội dung</label>
                                    <textarea id="feedback_content_{{ $index }}" name="feedback_items[{{ $index }}][content]" rows="3" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ data_get($item, 'content') }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="grid gap-5 md:grid-cols-2">
                <x-backend.form.input id="sort_order" name="sort_order" type="number" label="Thứ tự" :value="$widget->sort_order" />
                <label class="flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $widget->is_active)) class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Hiển thị widget
                </label>
            </div>

            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Cập nhật widget</button>
        </form>
    </x-backend.panel>

    @if ($isFeedbackWidget)
        <template id="feedback-item-template">
            <div class="feedback-item rounded-xl border border-slate-200 bg-white p-4" data-feedback-item>
                <div class="mb-4 flex items-center justify-between gap-3">
                    <p class="text-sm font-semibold text-slate-700">Feedback #__NUMBER__</p>
                    <button type="button" class="text-sm font-medium text-red-600 hover:text-red-700" data-remove-feedback>Xóa</button>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <x-backend.form.input id="feedback_avatar___INDEX__" name="feedback_items[__INDEX__][avatar]" label="Avatar" value="/image/Rectangle 2.png" />
                    <x-backend.form.input id="feedback_role___INDEX__" name="feedback_items[__INDEX__][role]" label="Vai trò" value="Khách hàng" />
                    <x-backend.form.input id="feedback_name___INDEX__" name="feedback_items[__INDEX__][name]" label="Tên khách hàng" value="" />
                </div>
                <div class="mt-4">
                    <label for="feedback_content___INDEX__" class="mb-2 block text-sm font-medium text-slate-700">Nội dung</label>
                    <textarea id="feedback_content___INDEX__" name="feedback_items[__INDEX__][content]" rows="3" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"></textarea>
                </div>
            </div>
        </template>
    @endif
@endsection

@if ($isFeedbackWidget)
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const list = document.getElementById('feedback-items');
                const addButton = document.getElementById('add-feedback-item');
                const template = document.getElementById('feedback-item-template');

                if (!list || !addButton || !template) return;

                const refreshNumbers = function () {
                    list.querySelectorAll('[data-feedback-item]').forEach(function (item, index) {
                        const label = item.querySelector('p');
                        if (label) label.textContent = 'Feedback #' + (index + 1);
                    });
                };

                list.addEventListener('click', function (event) {
                    if (!event.target.matches('[data-remove-feedback]')) return;
                    event.target.closest('[data-feedback-item]')?.remove();
                    refreshNumbers();
                });

                addButton.addEventListener('click', function () {
                    const count = list.querySelectorAll('[data-feedback-item]').length;

                    if (count >= 10) {
                        alert('Tối đa 10 feedback.');
                        return;
                    }

                    const index = Date.now();
                    const html = template.innerHTML
                        .replaceAll('__INDEX__', index)
                        .replaceAll('__NUMBER__', count + 1);

                    list.insertAdjacentHTML('beforeend', html);
                    refreshNumbers();
                });
            });
        </script>
    @endpush
@endif