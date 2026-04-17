<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendWidget extends Model
{
    protected $fillable = [
        'key',
        'title',
        'sub_title',
        'description',
        'settings',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
    ];
}