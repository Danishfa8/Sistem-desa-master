<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name',
        'token',
        'device',
        'is_active'
    ];
}
