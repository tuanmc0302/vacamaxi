<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_title',
        'site_description',
        'logo',
        'favicon',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_image',
        'address',
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
}
