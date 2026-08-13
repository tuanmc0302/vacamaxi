<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Concerns\Translatable;

class FrontendWidget extends Model
{
    use Translatable;

    protected $fillable = [
        'key',
        'title',
        'title_en',
        'sub_title',
        'sub_title_en',
        'description',
        'description_en',
        'settings',
        'settings_en',
        'sort_order',
        'is_active',
    ];

    protected $translatable = [
        'title',
        'sub_title',
        'description',
    ];

    protected $casts = [
        'settings' => 'array',
        'settings_en' => 'array',
        'is_active' => 'boolean',
    ];

    public function getSettingsAttribute()
    {
        $settings = $this->castAttribute('settings', $this->attributes['settings'] ?? null) ?? [];
        $locale = \Illuminate\Support\Facades\App::getLocale();
        if ($locale === 'en') {
            $settingsEn = $this->castAttribute('settings_en', $this->attributes['settings_en'] ?? null) ?? [];
            return array_merge($settings, $settingsEn);
        }
        return $settings;
    }
}