<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Kecamatan
 *
 * @property $id
 * @property $nama_kecamatan
 * @property $created_at
 * @property $updated_at
 *
 * @property Desa[] $desas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Kecamatan extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nama_kecamatan'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function desas()
    {
        return $this->hasMany(\App\Models\Desa::class, 'id', 'kecamatan_id');
    }
    
}
