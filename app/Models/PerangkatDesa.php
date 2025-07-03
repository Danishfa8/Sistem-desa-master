<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PerangkatDesa
 *
 * @property $id
 * @property $desa_id
 * @property $nama
 * @property $jabatan
 * @property $foto
 * @property $created_at
 * @property $updated_at
 *
 * @property Desa $desa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PerangkatDesa extends Model
{
    use HasFactory;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['desa_id', 'nama', 'jabatan', 'foto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(\App\Models\Desa::class, 'desa_id', 'id');
    }
}
