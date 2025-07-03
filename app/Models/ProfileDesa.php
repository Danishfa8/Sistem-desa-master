<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfileDesa
 *
 * @property $id
 * @property $desa_id
 * @property $visi
 * @property $misi
 * @property $program_unggulan
 * @property $batas_wilayah
 * @property $alamat
 * @property $telepon
 * @property $foto
 * @property $created_at
 * @property $updated_at
 *
 * @property Desa $desa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProfileDesa extends Model
{
    use HasFactory;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['desa_id', 'visi', 'misi', 'program_unggulan', 'batas_wilayah', 'alamat', 'telepon', 'foto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(\App\Models\Desa::class, 'desa_id', 'id');
    }
}
