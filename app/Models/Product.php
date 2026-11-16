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
        'subtitle',
        'subtitle_en',
        'price_text',
        'price_text_en',
        'slug',
        'slug_en',
        'image',
        'gallery',
        'attributes',
        'attributes_en',
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
        'subtitle',
        'price_text',
        'attributes',
        'short_description',
        'description',
        'seo_title',
        'seo_description',
        'slug',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'gallery' => 'array',
        'attributes' => 'array',
        'attributes_en' => 'array',
    ];

    public const ATTRIBUTE_TYPE_TEXT = 'text';
    public const ATTRIBUTE_TYPE_COLOR = 'color';

    public static function attributeTypes(): array
    {
        return config('products.attribute_types', [
            'text' => ['label' => 'Văn bản (Text)', 'default' => ''],
            'color' => ['label' => 'Màu sắc (Color)', 'default' => '#ffffff'],
        ]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}