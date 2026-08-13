<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Concerns\Translatable;

class Expert extends Model
{
    use Translatable;

    protected $fillable = [
        'name',
        'role',
        'role_en',
        'image',
        'description',
        'description_en',
        'sort_order',
        'is_active',
    ];

    protected $translatable = [
        'role',
        'description',
    ];
}
