<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Concerns\Translatable;

class Category extends Model
{
    use Translatable;

    public const MODULE_PRODUCT = 'product';
    public const MODULE_NEWS = 'news';

    protected $fillable = [
        'module',
        'name',
        'name_en',
        'slug',
        'slug_en',
        'description',
        'description_en',
        'sort_order',
        'is_active',
    ];

    protected $translatable = [
        'name',
        'description',
        'slug',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}