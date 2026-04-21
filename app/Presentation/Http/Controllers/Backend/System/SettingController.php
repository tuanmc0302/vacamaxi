<?php

namespace App\Presentation\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use App\Services\SiteSettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(
        private readonly SiteSettingService $siteSettingService
    ) {}

    public function edit(): View
    {
        return view('backend.system.settings.edit', [
            'setting' => $this->siteSettingService->model(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $setting = $this->siteSettingService->model();

        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_title' => ['nullable', 'string', 'max:255'],
            'site_description' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'seo_keywords' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone_wine' => ['nullable', 'string', 'max:50'],
            'phone_beef' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'zalo_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'google_map_url' => ['nullable', 'url', 'max:255'],
            'google_map_embed_url' => ['nullable', 'string'],
            'logo' => ['nullable', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'favicon' => ['nullable', 'mimes:ico,png,jpg,jpeg,svg,webp', 'max:1024'],
            'seo_image' => ['nullable', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
        ]);

        foreach (['logo', 'favicon', 'seo_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($setting->{$field} && ! str_starts_with($setting->{$field}, 'http')) {
                    Storage::disk('public')->delete($setting->{$field});
                }

                $validated[$field] = $request->file($field)->store('settings', 'public');
            }
        }

        $setting->update($validated);

        return redirect()
            ->route('admin.settings.edit')
            ->with('status', 'Đã cập nhật cấu hình website.');
    }
}
