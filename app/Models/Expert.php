<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $fillable = [
        'name',
        'role',
        'image',
        'description',
        'sort_order',
        'is_active',
    ];
}
