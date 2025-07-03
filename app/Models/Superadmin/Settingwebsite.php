<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;

class Settingwebsite extends Model
{
    protected $fillable = [
        'title',
        'description',
        'favicon',
        'logo',
    ];
}
