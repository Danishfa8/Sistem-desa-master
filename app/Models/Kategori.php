<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'tipe', 'asal_id', 'latitude', 'logitude'];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'asal_id');
    }
}
