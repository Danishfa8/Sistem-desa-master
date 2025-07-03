<?php

namespace App\Models;

use App\Models\Scopes\StatusVisibilityScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JalanDesa
 *
 * @property $id
 * @property $desa_id
 * @property $rt_rw_desa_id
 * @property $nama_jalan
 * @property $panjang
 * @property $lebar
 * @property $kondisi
 * @property $jenis_jalan
 * @property $lokasi
 * @property $created_by
 * @property $updated_by
 * @property $status
 * @property $reject_reason
 * @property $approved_by
 * @property $approved_at
 * @property $latitude
 * @property $longitude
 * @property $created_at
 * @property $updated_at
 *
 * @property Desa $desa
 * @property RtRwDesa $rtRwDesa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class JalanDesa extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new StatusVisibilityScope);
    }

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['desa_id', 'rt_rw_desa_id', 'nama_jalan', 'panjang', 'lebar', 'kondisi', 'jenis_jalan', 'lokasi', 'created_by', 'updated_by', 'status', 'reject_reason', 'approved_by', 'approved_at', 'latitude', 'longitude'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(\App\Models\Desa::class, 'desa_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rtRwDesa()
    {
        return $this->belongsTo(\App\Models\RtRwDesa::class, 'rt_rw_desa_id', 'id');
    }
}
