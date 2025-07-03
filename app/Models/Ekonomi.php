<?php

namespace App\Models;

use App\Models\Scopes\StatusVisibilityScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ekonomi
 *
 * @property $id
 * @property $desa_id
 * @property $tahun
 * @property $jenis
 * @property $nama
 * @property $pemilik
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
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ekonomi extends Model
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
    protected $fillable = ['desa_id', 'tahun', 'jenis', 'nama', 'pemilik', 'created_by', 'updated_by', 'status', 'reject_reason', 'approved_by', 'approved_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(\App\Models\Desa::class, 'desa_id', 'id');
    }
}
