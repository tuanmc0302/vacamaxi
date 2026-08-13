<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Concerns\Translatable;

class Product extends Model
{
    use Translatable;

    protected $fillable = [
        'category_id',
        'name',
        'name_en',
        'slug',
        'slug_en',
        'image',
        'short_description',
        'short_description_en',
        'description',
        'description_en',
        'seo_title',
        'seo_title_en',
        'seo_description',
        'seo_description_en',
        'sort_order',
        'is_active',
    ];

    protected $translatable = [
        'name',
        'short_description',
        'description',
        'seo_title',
        'seo_description',
        'slug',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}