<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SaranaIbadahDesa
 *
 * @property $id
 * @property $desa_id
 * @property $rt_rw_desa_id
 * @property $tahun
 * @property $jenis_sarana_ibadah
 * @property $nama_sarana_ibadah
 * @property $foto
 * @property $latitude
 * @property $longitude
 * @property $created_by
 * @property $updated_by
 * @property $status
 * @property $reject_reason
 * @property $approved_by
 * @property $approved_at
 * @property $created_at
 * @property $updated_at
 *
 * @property Desa $desa
 * @property RtRwDesa $rtRwDesa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SaranaIbadahDesa extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['desa_id', 'rt_rw_desa_id', 'tahun', 'jenis_sarana_ibadah', 'nama_sarana_ibadah', 'foto', 'latitude', 'longitude', 'created_by', 'updated_by', 'status', 'reject_reason', 'approved_by', 'approved_at'];


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
