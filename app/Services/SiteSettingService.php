<?php

namespace App\Services;

use App\Models\SiteSetting;

class SiteSettingService
{
    public function model(): SiteSetting
    {
        return SiteSetting::query()->firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'VACAMAXI',
                'site_title' => 'VACAMAXI',
                'site_description' => 'VACAMAXI',
                'seo_title' => 'VACAMAXI',
                'seo_description' => 'VACAMAXI',
            ]
        );
    }

    public function viewData(): array
    {
        $setting = $this->model();

        return [
            'site_name' => $setting->site_name ?: 'VACAMAXI',
            'site_title' => $setting->site_title ?: ($setting->site_name ?: 'VACAMAXI'),
            'site_description' => $setting->site_description ?: 'VACAMAXI',
            'logo_url' => $this->assetUrl($setting->logo, asset('image/logo.png')),
            'favicon_url' => $this->assetUrl($setting->favicon, asset('favicon.ico')),
            'seo_title' => $setting->seo_title ?: ($setting->site_title ?: 'VACAMAXI'),
            'seo_description' => $setting->seo_description ?: ($setting->site_description ?: 'VACAMAXI'),
            'seo_keywords' => $setting->seo_keywords ?: '',
            'seo_image_url' => $this->assetUrl($setting->seo_image),
            'address' => $setting->address ?: '',
            'phone_wine' => $setting->phone_wine ?: '',
            'phone_beef' => $setting->phone_beef ?: '',
            'email' => $setting->email ?: '',
            'website_url' => $setting->website_url ?: '',
            'zalo_url' => $setting->zalo_url ?: '',
            'facebook_url' => $setting->facebook_url ?: '',
            'youtube_url' => $setting->youtube_url ?: '',
            'google_map_url' => $setting->google_map_url ?: '',
            'google_map_embed_url' => $setting->google_map_embed_url ?: '',
        ];
    }

    private function assetUrl(?string $path, ?string $fallback = null): ?string
    {
        if (! $path) {
            return $fallback;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return asset('storage/' . $path);
    }
}
