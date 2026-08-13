@extends('backend.layouts.app')

@section('title', 'Cấu hình website | Admin')
@section('eyebrow', 'Thiết lập hệ thống')
@section('page_heading', 'Cấu hình website')

@section('content')
    <div class="space-y-6">
        <x-backend.alert :message="session('status')" />
        <x-backend.alert type="error" :message="$errors->first()" />

        <x-backend.panel>
            <x-backend.page-header
                kicker="Settings"
                title="Thông tin chung & SEO"
                description="Cấu hình logo, favicon, SEO mặc định và thông tin liên hệ dùng chung trên toàn bộ website."
            />

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid gap-8 xl:grid-cols-2">
                    <section class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                        <h3 class="text-lg font-semibold text-slate-900">Thông tin thương hiệu</h3>
                        <div class="mt-5 grid gap-5 md:grid-cols-2">
                            <x-backend.form.input id="site_name" name="site_name" label="Tên thương hiệu (VI)" :value="$setting->site_name" placeholder="VACAMAXI" />
                            <x-backend.form.input id="site_name_en" name="site_name_en" label="Tên thương hiệu (EN)" :value="$setting->site_name_en" placeholder="VACAMAXI (EN)" />
                            <x-backend.form.input id="site_title" name="site_title" label="Tiêu đề website (VI)" :value="$setting->site_title" placeholder="VACAMAXI" />
                            <x-backend.form.input id="site_title_en" name="site_title_en" label="Tiêu đề website (EN)" :value="$setting->site_title_en" placeholder="VACAMAXI (EN)" />
                        </div>
                        <div class="mt-5">
                            <label for="site_description" class="mb-2 block text-sm font-medium text-slate-700">Mô tả thương hiệu (VI)</label>
                            <textarea id="site_description" name="site_description" rows="4" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('site_description', $setting->site_description) }}</textarea>
                        </div>
                        <div class="mt-5">
                            <label for="site_description_en" class="mb-2 block text-sm font-medium text-slate-700">Mô tả thương hiệu (EN)</label>
                            <textarea id="site_description_en" name="site_description_en" rows="4" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('site_description_en', $setting->site_description_en) }}</textarea>
                        </div>
                        <div class="mt-5 grid gap-5 md:grid-cols-3">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Logo</label>
                                <div class="overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200">
                                    <img src="{{ $setting->logo ? asset('storage/'.$setting->logo) : asset('image/logo.png') }}" alt="Logo" class="h-32 w-full object-contain p-4">
                                </div>
                                <input type="file" name="logo" accept="image/*" class="mt-3 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Favicon</label>
                                <div class="overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200">
                                    <img src="{{ $setting->favicon ? asset('storage/'.$setting->favicon) : asset('favicon.ico') }}" alt="Favicon" class="h-32 w-full object-contain p-6">
                                </div>
                                <input type="file" name="favicon" accept="image/*" class="mt-3 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Ảnh SEO</label>
                                <div class="overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200">
                                    <img src="{{ $setting->seo_image ? asset('storage/'.$setting->seo_image) : asset('image/logo.png') }}" alt="SEO image" class="h-32 w-full object-contain p-4">
                                </div>
                                <input type="file" name="seo_image" accept="image/*" class="mt-3 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none">
                            </div>
                        </div>
                    </section>

                    <section class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                        <h3 class="text-lg font-semibold text-slate-900">SEO mặc định</h3>
                        <div class="mt-5 grid gap-5">
                            <x-backend.form.input id="seo_title" name="seo_title" label="SEO title (VI)" :value="$setting->seo_title" placeholder="Tiêu đề SEO mặc định" />
                            <x-backend.form.input id="seo_title_en" name="seo_title_en" label="SEO title (EN)" :value="$setting->seo_title_en" placeholder="Tiêu đề SEO mặc định (EN)" />
                            <div>
                                <label for="seo_description" class="mb-2 block text-sm font-medium text-slate-700">SEO description (VI)</label>
                                <textarea id="seo_description" name="seo_description" rows="4" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('seo_description', $setting->seo_description) }}</textarea>
                            </div>
                            <div>
                                <label for="seo_description_en" class="mb-2 block text-sm font-medium text-slate-700">SEO description (EN)</label>
                                <textarea id="seo_description_en" name="seo_description_en" rows="4" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('seo_description_en', $setting->seo_description_en) }}</textarea>
                            </div>
                            <div>
                                <label for="seo_keywords" class="mb-2 block text-sm font-medium text-slate-700">SEO keywords (VI)</label>
                                <textarea id="seo_keywords" name="seo_keywords" rows="4" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('seo_keywords', $setting->seo_keywords) }}</textarea>
                            </div>
                            <div>
                                <label for="seo_keywords_en" class="mb-2 block text-sm font-medium text-slate-700">SEO keywords (EN)</label>
                                <textarea id="seo_keywords_en" name="seo_keywords_en" rows="4" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('seo_keywords_en', $setting->seo_keywords_en) }}</textarea>
                            </div>
                        </div>
                    </section>
                </div>

                <section class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <h3 class="text-lg font-semibold text-slate-900">Thông tin liên hệ</h3>
                    <div class="mt-5 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                        <x-backend.form.input id="address" name="address" label="Địa chỉ (VI)" :value="$setting->address" placeholder="Nhập địa chỉ" />
                        <x-backend.form.input id="address_en" name="address_en" label="Địa chỉ (EN)" :value="$setting->address_en" placeholder="Nhập địa chỉ (EN)" />
                        <x-backend.form.input id="phone_wine" name="phone_wine" label="SĐT về rượu" :value="$setting->phone_wine" placeholder="0983..." />
                        <x-backend.form.input id="phone_beef" name="phone_beef" label="SĐT về bò" :value="$setting->phone_beef" placeholder="0988..." />
                        <x-backend.form.input id="email" name="email" label="Email" type="email" :value="$setting->email" placeholder="info@example.com" />
                        <x-backend.form.input id="website_url" name="website_url" label="Website" :value="$setting->website_url" placeholder="https://vacamaxi.vn" />
                        <x-backend.form.input id="google_map_url" name="google_map_url" label="Link Google Map" :value="$setting->google_map_url" placeholder="https://maps.google.com/..." />
                        <x-backend.form.input id="zalo_url" name="zalo_url" label="Link Zalo" :value="$setting->zalo_url" placeholder="https://zalo.me/..." />
                        <x-backend.form.input id="facebook_url" name="facebook_url" label="Link Facebook" :value="$setting->facebook_url" placeholder="https://facebook.com/..." />
                        <x-backend.form.input id="youtube_url" name="youtube_url" label="Link Youtube" :value="$setting->youtube_url" placeholder="https://youtube.com/..." />
                    </div>
                    <div class="mt-5">
                        <label for="google_map_embed_url" class="mb-2 block text-sm font-medium text-slate-700">Google Map embed / iframe src</label>
                        <textarea id="google_map_embed_url" name="google_map_embed_url" rows="4" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('google_map_embed_url', $setting->google_map_embed_url) }}</textarea>
                    </div>
                </section>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-6 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Lưu cấu hình
                    </button>
                </div>
            </form>
        </x-backend.panel>
    </div>
@endsection
