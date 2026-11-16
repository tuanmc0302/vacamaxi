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
        'parent_id',
        'module',
        'name',
        'name_en',
        'slug',
        'slug_en',
        'description',
        'description_en',
        'sort_order',
        'is_active',
        'is_18_plus',
    ];

    protected $translatable = [
        'name',
        'description',
        'slug',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_18_plus' => 'boolean',
    ];

    public function requiresAgeVerification(): bool
    {
        if (! empty($this->attributes['is_18_plus'])) {
            return true;
        }

        // Fallback nhận diện danh mục rượu theo slug nếu chưa chạy migrate trên server
        if (in_array($this->slug, ['ruou', 'ruou-369', 'wine'], true)) {
            return true;
        }

        if ($this->parent_id && $this->parent) {
            return $this->parent->requiresAgeVerification();
        }

        return false;
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order')->orderBy('name');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}