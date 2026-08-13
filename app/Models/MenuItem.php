<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Concerns\Translatable;

class MenuItem extends Model
{
    use Translatable;

    protected $fillable = [
        'label',
        'label_en',
        'url',
        'url_en',
        'key',
        'parent_id',
        'sort_order',
        'target',
        'is_active',
    ];

    protected $translatable = [
        'label',
        'url',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}
