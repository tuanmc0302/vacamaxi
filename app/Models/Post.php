<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Concerns\Translatable;

class Post extends Model
{
    use Translatable;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'title_en',
        'slug',
        'slug_en',
        'image',
        'description',
        'description_en',
        'content',
        'content_en',
        'seo_title',
        'seo_title_en',
        'seo_description',
        'seo_description_en',
        'published_at',
        'is_active',
    ];

    protected $translatable = [
        'title',
        'description',
        'content',
        'seo_title',
        'seo_description',
        'slug',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }
}