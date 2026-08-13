<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Concerns\Translatable;

class SiteSetting extends Model
{
    use Translatable;

    protected $fillable = [
        'site_name',
        'site_name_en',
        'site_title',
        'site_title_en',
        'site_description',
        'site_description_en',
        'logo',
        'favicon',
        'seo_title',
        'seo_title_en',
        'seo_description',
        'seo_description_en',
        'seo_keywords',
        'seo_keywords_en',
        'seo_image',
        'address',
        'address_en',
        'phone_wine',
        'phone_beef',
        'email',
        'website_url',
        'zalo_url',
        'facebook_url',
        'youtube_url',
        'google_map_url',
        'google_map_embed_url',
    ];

    protected $translatable = [
        'site_name',
        'site_title',
        'site_description',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'address',
    ];
}
