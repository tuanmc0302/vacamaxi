@extends('backend.layouts.app')

@php
    $isEdit = $product->exists;
@endphp

@section('title', ($isEdit ? 'Sửa sản phẩm' : 'Thêm sản phẩm') . ' | Admin')
@section('eyebrow', 'Quản trị nội dung')
@section('page_heading', $isEdit ? 'Sửa sản phẩm' : 'Thêm sản phẩm')

@push('styles')
<style>
    .ck-editor__editable_inline {
        min-height: 260px;
    }
</style>
@endpush

@section('content')
    <form method="POST" action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tên sản phẩm (VI)</label>
                    <input name="name" value="{{ old('name', $product->name) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50" required>
                    @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tên sản phẩm (EN)</label>
                    <input name="name_en" value="{{ old('name_en', $product->name_en) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('name_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Phụ đề / Quy cách (VI)</label>
                    <input name="subtitle" value="{{ old('subtitle', $product->subtitle) }}" placeholder="Ví dụ: 500ml - 33%vol" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('subtitle') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Phụ đề / Quy cách (EN)</label>
                    <input name="subtitle_en" value="{{ old('subtitle_en', $product->subtitle_en) }}" placeholder="Ví dụ: 500ml - 33%vol" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('subtitle_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Giá / Trạng thái hiển thị (VI)</label>
                    <input name="price_text" value="{{ old('price_text', $product->price_text) }}" placeholder="Mặc định: Liên hệ (ví dụ: 150.000 đ, Liên hệ...)" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('price_text') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Giá / Trạng thái hiển thị (EN)</label>
                    <input name="price_text_en" value="{{ old('price_text_en', $product->price_text_en) }}" placeholder="Mặc định: Contact (ví dụ: $25, Contact...)" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('price_text_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Slug</label>
                    <input name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Tự tạo nếu để trống" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Danh mục</label>
                    <select name="category_id" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                        <option value="">Chưa chọn</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @selected((string) old('category_id', $product->category_id) === (string) $cat->id)>
                                {{ $cat->parent ? '↳ ' . $cat->name . ' (' . $cat->parent->name . ')' : $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Upload ảnh</label>
                    <input type="file" name="image_file" accept="image/*" class="block h-12 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-slate-900 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('image_file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    @if ($product->image)
                        <div class="mt-3 flex items-center gap-3 text-xs text-slate-500">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="h-14 w-20 rounded-lg object-cover">
                            <span>Ảnh hiện tại: {{ $product->image }}</span>
                        </div>
                    @endif
                </div>
                <div class="md:col-span-2 rounded-xl border border-slate-200 bg-slate-50/60 p-4">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Upload ảnh phụ (Gallery - chọn nhiều ảnh cùng lúc)</label>
                    <input type="file" id="gallery_files_input" name="gallery_files[]" accept="image/*" multiple class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    <p class="mt-1 text-xs text-slate-500">Giữ phím Ctrl (hoặc Shift) để chọn nhiều ảnh cùng một lúc.</p>
                    @error('gallery_files.*') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror

                    {{-- Vùng xem trước ảnh mới chọn --}}
                    <div id="new_gallery_preview_wrapper" class="mt-4 hidden border-t border-slate-200 pt-3">
                        <p class="text-xs font-semibold text-blue-700 mb-2">Ảnh mới chọn xem trước:</p>
                        <div id="new_gallery_preview" class="flex flex-wrap gap-3"></div>
                    </div>

                    {{-- Vùng ảnh phụ hiện tại --}}
                    @if (!empty($product->gallery) && is_array($product->gallery))
                        <div class="mt-4 border-t border-slate-200 pt-3">
                            <p class="text-xs font-semibold text-slate-700 mb-2">Ảnh phụ hiện tại (bấm nút đỏ trên góc ảnh để xóa):</p>
                            <div class="flex flex-wrap gap-3" id="existing_gallery_container">
                                @foreach ($product->gallery as $idx => $galleryImage)
                                    <div class="relative group rounded-lg overflow-hidden border border-slate-200 bg-white shadow-sm" id="gallery_item_{{ $idx }}">
                                        <img src="{{ asset($galleryImage) }}" alt="Gallery" class="h-20 w-24 object-cover">
                                        <input type="hidden" name="existing_gallery[]" value="{{ $galleryImage }}">
                                        <button type="button" onclick="removeExistingGalleryImage('gallery_item_{{ $idx }}')" class="absolute top-1 right-1 h-6 w-6 rounded-full bg-red-600 text-white flex items-center justify-center opacity-85 hover:opacity-100 transition shadow" title="Xóa ảnh này">
                                            <i class="bi bi-x text-base font-bold"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Thứ tự</label>
                    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('sort_order') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <label class="flex items-center gap-3 self-end rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active)) class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Hiển thị
                </label>
            </div>
        </div>

        <?php
            $attributeTypes = \App\Models\Product::attributeTypes();

            $rawAttrs = old('attributes_json') ? json_decode(old('attributes_json'), true) : ($product->attributes ?? []);
            if (!is_array($rawAttrs)) {
                $rawAttrs = [];
            }
            $attrRows = [];
            foreach ($rawAttrs as $k => $v) {
                if (is_array($v) && (isset($v['key']) || isset($v['name']) || isset($v['label']))) {
                    $key = $v['label'] ?? $v['name'] ?? $v['key'];
                    $val = $v['value'] ?? $v['val'] ?? '';
                    $type = in_array($v['type'] ?? '', ['color', 'text'], true) ? $v['type'] : ((preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', (string)$val) || in_array(mb_strtolower($key), ['màu sắc', 'màu', 'color'])) ? 'color' : 'text');
                    $attrRows[] = ['key' => $key, 'type' => $type, 'value' => $val];
                } else {
                    $key = is_string($k) ? $k : '';
                    $val = is_scalar($v) ? (string)$v : json_encode($v, JSON_UNESCAPED_UNICODE);
                    $type = (preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', (string)$val) || in_array(mb_strtolower($key), ['màu sắc', 'màu', 'color'])) ? 'color' : 'text';
                    $attrRows[] = ['key' => $key, 'type' => $type, 'value' => $val];
                }
            }

            $rawAttrsEn = old('attributes_en_json') ? json_decode(old('attributes_en_json'), true) : ($product->attributes_en ?? []);
            if (!is_array($rawAttrsEn)) {
                $rawAttrsEn = [];
            }
            $attrRowsEn = [];
            foreach ($rawAttrsEn as $k => $v) {
                if (is_array($v) && (isset($v['key']) || isset($v['name']) || isset($v['label']))) {
                    $key = $v['label'] ?? $v['name'] ?? $v['key'];
                    $val = $v['value'] ?? $v['val'] ?? '';
                    $type = in_array($v['type'] ?? '', ['color', 'text'], true) ? $v['type'] : ((preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', (string)$val) || in_array(mb_strtolower($key), ['colour', 'color'])) ? 'color' : 'text');
                    $attrRowsEn[] = ['key' => $key, 'type' => $type, 'value' => $val];
                } else {
                    $key = is_string($k) ? $k : '';
                    $val = is_scalar($v) ? (string)$v : json_encode($v, JSON_UNESCAPED_UNICODE);
                    $type = (preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', (string)$val) || in_array(mb_strtolower($key), ['colour', 'color'])) ? 'color' : 'text';
                    $attrRowsEn[] = ['key' => $key, 'type' => $type, 'value' => $val];
                }
            }
        ?>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Thông số & Đặc tính sản phẩm (JSON / Thuộc tính tùy biến)</h3>
                    <p class="text-xs text-slate-500 mt-1">Hỗ trợ các kiểu dữ liệu: <strong>Văn bản (Text)</strong> và <strong>Màu sắc (Color picker)</strong>.</p>
                </div>
                <div class="flex rounded-xl bg-slate-100 p-1">
                    <button type="button" onclick="switchAttrLang('vi')" id="tab_attr_btn_vi" class="rounded-lg px-4 py-1.5 text-xs font-bold transition bg-white text-slate-900 shadow-sm">
                        Tiếng Việt (VI)
                    </button>
                    <button type="button" onclick="switchAttrLang('en')" id="tab_attr_btn_en" class="rounded-lg px-4 py-1.5 text-xs font-bold transition text-slate-600 hover:text-slate-900">
                        Tiếng Anh (EN)
                    </button>
                </div>
            </div>

            {{-- KHỐI TIẾNG VIỆT --}}
            <div id="attr_lang_panel_vi" class="space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3">
                    <span class="text-xs font-bold text-slate-700">Đặc tính Tiếng Việt (VI)</span>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="loadWineAttributesPreset('vi')" class="inline-flex items-center gap-1.5 rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-800 hover:bg-amber-100 transition shadow-sm">
                            <i class="bi bi-magic"></i> Nạp mẫu Rượu (Trạng thái, Màu sắc, Mùi vị)
                        </button>
                        <button type="button" onclick="toggleAttributesMode('vi')" id="btn_toggle_attr_mode_vi" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition shadow-sm">
                            <i class="bi bi-code-slash"></i> Sửa JSON trực tiếp
                        </button>
                    </div>
                </div>

                {{-- Visual repeater VI --}}
                <div id="attributes_visual_mode_vi">
                    <div id="attributes_repeater_container_vi" class="space-y-3">
                        @forelse(($attrRows ?? []) as $idx => $row)
                            @php
                                $isColor = ($row['type'] ?? 'text') === 'color';
                                $colorVal = preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', $row['value'] ?? '') ? $row['value'] : '#ffffff';
                            @endphp
                            <div class="attr-row-vi flex flex-wrap sm:flex-nowrap items-center gap-2.5">
                                <input type="text" name="attribute_keys[]" value="{{ $row['key'] }}" placeholder="Tên thuộc tính (vd: Trạng thái, Màu sắc)" class="h-11 w-full sm:w-1/3 rounded-xl border border-slate-200 px-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50 bg-white" oninput="syncAttrsToJson('vi')">
                                <select name="attribute_types[]" class="h-11 w-36 rounded-xl border border-slate-200 px-3 text-xs font-semibold text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50 bg-white" onchange="onAttrTypeChange(this, 'vi')">
                                    @foreach($attributeTypes as $tKey => $tConfig)
                                        <option value="{{ $tKey }}" @selected(($row['type'] ?? 'text') === $tKey)>{{ $tConfig['label'] }}</option>
                                    @endforeach
                                </select>
                                <div class="attr-val-box flex-1 flex items-center gap-2 w-full">
                                    <input type="color" value="{{ $colorVal }}" class="attr-color-picker h-11 w-12 p-1 rounded-xl border border-slate-200 cursor-pointer bg-white {{ $isColor ? '' : 'hidden' }}" oninput="onColorPickerChange(this, 'vi')" title="Chọn mã màu">
                                    <input type="text" name="attribute_values[]" value="{{ $row['value'] }}" placeholder="{{ $isColor ? 'Mã màu (#ffffff) hoặc tên màu' : 'Giá trị (vd: Chất lỏng trong suốt...)' }}" class="attr-text-input h-11 flex-1 rounded-xl border border-slate-200 px-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50 bg-white" oninput="onColorHexInput(this, 'vi')">
                                </div>
                                <button type="button" onclick="this.closest('.attr-row-vi').remove(); syncAttrsToJson('vi');" class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-red-200 text-red-600 hover:bg-red-50 transition" title="Xóa dòng này">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @empty
                        @endforelse
                    </div>

                    <div class="mt-4 flex items-center gap-3">
                        <button type="button" onclick="addAttributeRow('vi')" class="inline-flex items-center gap-1.5 rounded-xl border border-blue-200 bg-blue-50 px-4 py-2 text-xs font-bold text-blue-700 hover:bg-blue-100 transition">
                            <i class="bi bi-plus-lg"></i> Thêm thuộc tính (VI)
                        </button>
                    </div>
                </div>

                {{-- JSON mode VI --}}
                <div id="attributes_json_mode_vi" class="hidden">
                    <textarea id="attributes_json_input_vi" name="attributes_json" rows="6" class="w-full font-mono text-xs rounded-xl border border-slate-200 bg-slate-50 p-4 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50" placeholder='[{"key": "Trạng thái", "type": "text", "value": "Chất lỏng trong suốt"}, {"key": "Màu sắc", "type": "color", "value": "#ffffff"}]'>{{ json_encode($product->attributes ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</textarea>
                    <p class="mt-1 text-xs text-slate-500">JSON Tiếng Việt dạng danh sách <code>[{"key": "Tên", "type": "text|color", "value": "Giá trị"}]</code>.</p>
                </div>
            </div>

            {{-- KHỐI TIẾNG ANH --}}
            <div id="attr_lang_panel_en" class="hidden space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3">
                    <span class="text-xs font-bold text-slate-700">Đặc tính Tiếng Anh (EN)</span>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="loadWineAttributesPreset('en')" class="inline-flex items-center gap-1.5 rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-800 hover:bg-amber-100 transition shadow-sm">
                            <i class="bi bi-magic"></i> Nạp mẫu Rượu EN (Appearance, Color, Taste)
                        </button>
                        <button type="button" onclick="toggleAttributesMode('en')" id="btn_toggle_attr_mode_en" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition shadow-sm">
                            <i class="bi bi-code-slash"></i> Sửa JSON trực tiếp
                        </button>
                    </div>
                </div>

                {{-- Visual repeater EN --}}
                <div id="attributes_visual_mode_en">
                    <div id="attributes_repeater_container_en" class="space-y-3">
                        @forelse(($attrRowsEn ?? []) as $idx => $row)
                            @php
                                $isColorEn = ($row['type'] ?? 'text') === 'color';
                                $colorValEn = preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', $row['value'] ?? '') ? $row['value'] : '#ffffff';
                            @endphp
                            <div class="attr-row-en flex flex-wrap sm:flex-nowrap items-center gap-2.5">
                                <input type="text" name="attribute_keys_en[]" value="{{ $row['key'] }}" placeholder="Attribute name (e.g. Appearance, Color)" class="h-11 w-full sm:w-1/3 rounded-xl border border-slate-200 px-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50 bg-white" oninput="syncAttrsToJson('en')">
                                <select name="attribute_types_en[]" class="h-11 w-36 rounded-xl border border-slate-200 px-3 text-xs font-semibold text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50 bg-white" onchange="onAttrTypeChange(this, 'en')">
                                    @foreach($attributeTypes as $tKey => $tConfig)
                                        <option value="{{ $tKey }}" @selected(($row['type'] ?? 'text') === $tKey)>{{ $tConfig['label'] }}</option>
                                    @endforeach
                                </select>
                                <div class="attr-val-box flex-1 flex items-center gap-2 w-full">
                                    <input type="color" value="{{ $colorValEn }}" class="attr-color-picker h-11 w-12 p-1 rounded-xl border border-slate-200 cursor-pointer bg-white {{ $isColorEn ? '' : 'hidden' }}" oninput="onColorPickerChange(this, 'en')" title="Choose color">
                                    <input type="text" name="attribute_values_en[]" value="{{ $row['value'] }}" placeholder="{{ $isColorEn ? 'Color hex (#ffffff) or name' : 'Value (e.g. Clear liquid...)' }}" class="attr-text-input h-11 flex-1 rounded-xl border border-slate-200 px-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50 bg-white" oninput="onColorHexInput(this, 'en')">
                                </div>
                                <button type="button" onclick="this.closest('.attr-row-en').remove(); syncAttrsToJson('en');" class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-red-200 text-red-600 hover:bg-red-50 transition" title="Delete this row">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @empty
                        @endforelse
                    </div>

                    <div class="mt-4 flex items-center gap-3">
                        <button type="button" onclick="addAttributeRow('en')" class="inline-flex items-center gap-1.5 rounded-xl border border-blue-200 bg-blue-50 px-4 py-2 text-xs font-bold text-blue-700 hover:bg-blue-100 transition">
                            <i class="bi bi-plus-lg"></i> Thêm thuộc tính (EN)
                        </button>
                    </div>
                </div>

                {{-- JSON mode EN --}}
                <div id="attributes_json_mode_en" class="hidden">
                    <textarea id="attributes_json_input_en" name="attributes_en_json" rows="6" class="w-full font-mono text-xs rounded-xl border border-slate-200 bg-slate-50 p-4 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50" placeholder='[{"key": "Appearance", "type": "text", "value": "Clear liquid"}, {"key": "Color", "type": "color", "value": "#ffffff"}]'>{{ json_encode($product->attributes_en ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</textarea>
                    <p class="mt-1 text-xs text-slate-500">JSON Tiếng Anh dạng danh sách <code>[{"key": "Key", "type": "text|color", "value": "Value"}]</code>.</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-5">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả ngắn (VI)</label>
                    <textarea name="short_description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('short_description', $product->short_description) }}</textarea>
                    @error('short_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả ngắn (EN)</label>
                    <textarea name="short_description_en" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('short_description_en', $product->short_description_en) }}</textarea>
                    @error('short_description_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả sản phẩm (VI)</label>
                    <textarea id="description" name="description" rows="8" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Mô tả sản phẩm (EN)</label>
                    <textarea id="description_en" name="description_en" rows="8" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('description_en', $product->description_en) }}</textarea>
                    @error('description_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900">SEO</h2>
            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO title (VI)</label>
                    <input name="seo_title" value="{{ old('seo_title', $product->seo_title) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('seo_title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO title (EN)</label>
                    <input name="seo_title_en" value="{{ old('seo_title_en', $product->seo_title_en) }}" class="h-12 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                    @error('seo_title_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO description (VI)</label>
                    <textarea name="seo_description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('seo_description', $product->seo_description) }}</textarea>
                    @error('seo_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">SEO description (EN)</label>
                    <textarea name="seo_description_en" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">{{ old('seo_description_en', $product->seo_description_en) }}</textarea>
                    @error('seo_description_en') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">Quay lại</a>
            <button type="submit" class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Lưu sản phẩm</button>
        </div>
    </form>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    // Custom Upload Adapter cho CKEditor 5 để upload ảnh sản phẩm
    class ProductImageUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        const data = new FormData();
                        data.append('upload', file);
                        data.append('_token', '{{ csrf_token() }}');

                        fetch('{{ route('admin.products.editor-upload') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: data
                        })
                        .then(async response => {
                            let result = {};
                            try {
                                result = await response.json();
                            } catch (e) {
                                throw new Error('Máy chủ trả về dữ liệu không hợp lệ (' + response.status + ')');
                            }

                            if (!response.ok || result.uploaded === 0) {
                                throw new Error(result.error?.message || 'Lỗi tải ảnh lên máy chủ (' + response.status + ')');
                            }

                            return result;
                        })
                        .then(result => {
                            const url = result.url || result.default;
                            if (url) {
                                resolve({
                                    default: url
                                });
                            } else {
                                reject(result.error?.message || 'Không tìm thấy đường dẫn ảnh');
                            }
                        })
                        .catch(error => {
                            reject(error.message || 'Không thể tải ảnh lên');
                        });
                    }));
            }

            abort() {}
        }

        function ProductUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new ProductImageUploadAdapter(loader);
            };
        }

    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo CKEditor 5 cho Mô tả sản phẩm
        const editors = ['#description', '#description_en'];
        editors.forEach(selector => {
            const editorEl = document.querySelector(selector);
            if (editorEl && window.ClassicEditor) {
                ClassicEditor.create(editorEl, {
                    extraPlugins: [ProductUploadAdapterPlugin],
                    image: {
                        toolbar: [
                            'imageTextAlternative',
                            'toggleImageCaption',
                            'imageStyle:inline',
                            'imageStyle:block',
                            'imageStyle:side'
                        ]
                    }
                }).catch(function (error) {
                    console.error(error);
                });
            }
        });

        const input = document.getElementById('gallery_files_input');
        const previewWrapper = document.getElementById('new_gallery_preview_wrapper');
        const previewContainer = document.getElementById('new_gallery_preview');

        if (input && previewContainer) {
            input.addEventListener('change', function(e) {
                previewContainer.innerHTML = '';
                const files = Array.from(e.target.files);

                if (files.length > 0) {
                    previewWrapper.classList.remove('hidden');
                    files.forEach(function(file) {
                        if (!file.type.startsWith('image/')) return;

                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const item = document.createElement('div');
                            item.className = 'relative rounded-lg overflow-hidden border border-blue-300 bg-white shadow-sm';
                            item.innerHTML = `
                                <img src="${event.target.result}" alt="${file.name}" class="h-20 w-24 object-cover">
                                <span class="absolute bottom-0 left-0 right-0 bg-slate-900/70 text-white text-[10px] px-1 py-0.5 truncate text-center block" title="${file.name}">${file.name}</span>
                            `;
                            previewContainer.appendChild(item);
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    previewWrapper.classList.add('hidden');
                }
            });
        }
    });

    function removeExistingGalleryImage(itemId) {
        const item = document.getElementById(itemId);
        if (item) {
            item.remove();
        }
    }

    function switchAttrLang(lang) {
        const panelVi = document.getElementById('attr_lang_panel_vi');
        const panelEn = document.getElementById('attr_lang_panel_en');
        const btnVi = document.getElementById('tab_attr_btn_vi');
        const btnEn = document.getElementById('tab_attr_btn_en');

        if (lang === 'en') {
            panelVi.classList.add('hidden');
            panelEn.classList.remove('hidden');
            btnEn.className = 'rounded-lg px-4 py-1.5 text-xs font-bold transition bg-white text-slate-900 shadow-sm';
            btnVi.className = 'rounded-lg px-4 py-1.5 text-xs font-bold transition text-slate-600 hover:text-slate-900';
        } else {
            panelEn.classList.add('hidden');
            panelVi.classList.remove('hidden');
            btnVi.className = 'rounded-lg px-4 py-1.5 text-xs font-bold transition bg-white text-slate-900 shadow-sm';
            btnEn.className = 'rounded-lg px-4 py-1.5 text-xs font-bold transition text-slate-600 hover:text-slate-900';
        }
    }

    function addAttributeRow(lang = 'vi', key = '', type = 'text', value = '') {
        const isEn = lang === 'en';
        const container = document.getElementById(isEn ? 'attributes_repeater_container_en' : 'attributes_repeater_container_vi');
        if (!container) return;

        const row = document.createElement('div');
        row.className = (isEn ? 'attr-row-en' : 'attr-row-vi') + ' flex flex-wrap sm:flex-nowrap items-center gap-2.5';
        const keyName = isEn ? 'attribute_keys_en[]' : 'attribute_keys[]';
        const typeName = isEn ? 'attribute_types_en[]' : 'attribute_types[]';
        const valName = isEn ? 'attribute_values_en[]' : 'attribute_values[]';
        const keyPlaceholder = isEn ? 'Attribute name (e.g. Appearance, Color)' : 'Tên thuộc tính (vd: Trạng thái, Màu sắc)';
        const isColor = type === 'color';
        const colorVal = /^#([a-f0-9]{3}|[a-f0-9]{6})$/i.test(value) ? value : '#ffffff';
        const valPlaceholder = isColor ? (isEn ? 'Color hex (#ffffff) or name' : 'Mã màu (#ffffff) hoặc tên màu') : (isEn ? 'Value' : 'Giá trị');

        row.innerHTML = `
            <input type="text" name="${keyName}" value="${escapeHtml(key)}" placeholder="${keyPlaceholder}" class="h-11 w-full sm:w-1/3 rounded-xl border border-slate-200 px-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50 bg-white" oninput="syncAttrsToJson('${lang}')">
            <select name="${typeName}" class="h-11 w-36 rounded-xl border border-slate-200 px-3 text-xs font-semibold text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50 bg-white" onchange="onAttrTypeChange(this, '${lang}')">
                <option value="text" ${type === 'text' ? 'selected' : ''}>${isEn ? 'Văn bản (Text)' : 'Văn bản (Text)'}</option>
                <option value="color" ${type === 'color' ? 'selected' : ''}>${isEn ? 'Màu sắc (Color)' : 'Màu sắc (Color)'}</option>
            </select>
            <div class="attr-val-box flex-1 flex items-center gap-2 w-full">
                <input type="color" value="${colorVal}" class="attr-color-picker h-11 w-12 p-1 rounded-xl border border-slate-200 cursor-pointer bg-white ${isColor ? '' : 'hidden'}" oninput="onColorPickerChange(this, '${lang}')" title="Chọn màu">
                <input type="text" name="${valName}" value="${escapeHtml(value)}" placeholder="${valPlaceholder}" class="attr-text-input h-11 flex-1 rounded-xl border border-slate-200 px-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-50 bg-white" oninput="onColorHexInput(this, '${lang}')">
            </div>
            <button type="button" onclick="this.closest('.${isEn ? 'attr-row-en' : 'attr-row-vi'}').remove(); syncAttrsToJson('${lang}');" class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-red-200 text-red-600 hover:bg-red-50 transition" title="Xóa dòng này">
                <i class="bi bi-trash"></i>
            </button>
        `;
        container.appendChild(row);
        syncAttrsToJson(lang);
    }

    function onAttrTypeChange(selectEl, lang) {
        const isEn = lang === 'en';
        const row = selectEl.closest(isEn ? '.attr-row-en' : '.attr-row-vi');
        if (!row) return;

        const colorPicker = row.querySelector('.attr-color-picker');
        const textInput = row.querySelector('.attr-text-input');
        const isColor = selectEl.value === 'color';

        if (isColor) {
            colorPicker.classList.remove('hidden');
            textInput.placeholder = isEn ? 'Color hex (#ffffff) or name' : 'Mã màu (#ffffff) hoặc tên màu';
            if (!textInput.value.trim() || !textInput.value.startsWith('#')) {
                textInput.value = colorPicker.value || '#ffffff';
            }
        } else {
            colorPicker.classList.add('hidden');
            textInput.placeholder = isEn ? 'Value' : 'Giá trị';
        }
        syncAttrsToJson(lang);
    }

    function onColorPickerChange(colorInput, lang) {
        const isEn = lang === 'en';
        const row = colorInput.closest(isEn ? '.attr-row-en' : '.attr-row-vi');
        if (!row) return;
        const textInput = row.querySelector('.attr-text-input');
        if (textInput) {
            textInput.value = colorInput.value;
        }
        syncAttrsToJson(lang);
    }

    function onColorHexInput(textInput, lang) {
        const isEn = lang === 'en';
        const row = textInput.closest(isEn ? '.attr-row-en' : '.attr-row-vi');
        if (!row) return;
        const colorPicker = row.querySelector('.attr-color-picker');
        const select = row.querySelector(isEn ? 'select[name="attribute_types_en[]"]' : 'select[name="attribute_types[]"]');
        if (select && select.value === 'color' && colorPicker) {
            const val = textInput.value.trim();
            if (/^#([a-f0-9]{3}|[a-f0-9]{6})$/i.test(val)) {
                colorPicker.value = val;
            }
        }
        syncAttrsToJson(lang);
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

    function loadWineAttributesPreset(lang = 'vi') {
        if (lang === 'en') {
            const container = document.getElementById('attributes_repeater_container_en');
            if (!container) return;
            container.innerHTML = '';
            addAttributeRow('en', 'Appearance', 'text', 'Clear liquid');
            addAttributeRow('en', 'Color', 'color', '#ffffff');
            addAttributeRow('en', 'Taste', 'text', 'Characteristic aroma of fermented sticky rice wine, smooth taste.');
        } else {
            const container = document.getElementById('attributes_repeater_container_vi');
            if (!container) return;
            container.innerHTML = '';
            addAttributeRow('vi', 'Trạng thái', 'text', 'Chất lỏng trong suốt');
            addAttributeRow('vi', 'Màu sắc', 'color', '#ffffff');
            addAttributeRow('vi', 'Mùi vị', 'text', 'Có mùi vị đặc trưng của rượu lên men từ Gạo nếp cái hoa vàng, vị êm dịu.');
        }
    }

    function syncAttrsToJson(lang = 'vi') {
        const isEn = lang === 'en';
        const rows = document.querySelectorAll(isEn ? '.attr-row-en' : '.attr-row-vi');
        const result = [];
        rows.forEach(row => {
            const key = row.querySelector(isEn ? 'input[name="attribute_keys_en[]"]' : 'input[name="attribute_keys[]"]')?.value.trim();
            const type = row.querySelector(isEn ? 'select[name="attribute_types_en[]"]' : 'select[name="attribute_types[]"]')?.value || 'text';
            const val = row.querySelector(isEn ? 'input[name="attribute_values_en[]"]' : 'input[name="attribute_values[]"]')?.value.trim();
            if (key) {
                result.push({ key: key, type: type, value: val });
            }
        });
        const jsonInput = document.getElementById(isEn ? 'attributes_json_input_en' : 'attributes_json_input_vi');
        if (jsonInput) {
            jsonInput.value = result.length > 0 ? JSON.stringify(result, null, 2) : '';
        }
    }

    function syncJsonToAttrs(lang = 'vi') {
        const isEn = lang === 'en';
        const jsonInput = document.getElementById(isEn ? 'attributes_json_input_en' : 'attributes_json_input_vi');
        const container = document.getElementById(isEn ? 'attributes_repeater_container_en' : 'attributes_repeater_container_vi');
        if (!jsonInput || !container || !jsonInput.value.trim()) return;

        try {
            const parsed = JSON.parse(jsonInput.value);
            if (Array.isArray(parsed)) {
                container.innerHTML = '';
                parsed.forEach(item => {
                    if (item && item.key) {
                        addAttributeRow(lang, item.key, item.type || 'text', item.value || '');
                    }
                });
            } else if (typeof parsed === 'object' && parsed !== null) {
                container.innerHTML = '';
                for (const [k, v] of Object.entries(parsed)) {
                    const isCol = /^#([a-f0-9]{3}|[a-f0-9]{6})$/i.test(String(v)) || /màu|color/i.test(k);
                    addAttributeRow(lang, k, isCol ? 'color' : 'text', typeof v === 'object' ? JSON.stringify(v) : v);
                }
            }
        } catch (e) {
            // invalid JSON
        }
    }

    const attrModes = { vi: false, en: false };
    function toggleAttributesMode(lang = 'vi') {
        const isEn = lang === 'en';
        const visualMode = document.getElementById(isEn ? 'attributes_visual_mode_en' : 'attributes_visual_mode_vi');
        const jsonMode = document.getElementById(isEn ? 'attributes_json_mode_en' : 'attributes_json_mode_vi');
        const btn = document.getElementById(isEn ? 'btn_toggle_attr_mode_en' : 'btn_toggle_attr_mode_vi');

        attrModes[lang] = !attrModes[lang];
        if (attrModes[lang]) {
            syncAttrsToJson(lang);
            visualMode.classList.add('hidden');
            jsonMode.classList.remove('hidden');
            btn.innerHTML = '<i class="bi bi-card-list"></i> Xem dạng bảng trực quan';
        } else {
            syncJsonToAttrs(lang);
            jsonMode.classList.add('hidden');
            visualMode.classList.remove('hidden');
            btn.innerHTML = '<i class="bi bi-code-slash"></i> Sửa JSON trực tiếp';
        }
    }
</script>
@endpush