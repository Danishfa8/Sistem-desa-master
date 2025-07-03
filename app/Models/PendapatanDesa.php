<?php

namespace App\Models;

use App\Models\Scopes\StatusVisibilityScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PendapatanDesa
 *
 * @property $id
 * @property $desa_id
 * @property $sumber_pendapatan
 * @property $jumlah_pendapatan
 * @property $created_at
 * @property $updated_at
 *
 * @property Desa $desa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PendapatanDesa extends Model
{
    use HasFactory;

    /**
     * The "booted" method is called when the model is being booted.
     * Here we add a global scope to filter the results based on the status.
     *
     * @return void
     */
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
    protected $fillable = ['desa_id', 'sumber_pendapatan', 'jumlah_pendapatan'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(\App\Models\Desa::class, 'desa_id', 'id');
    }
}
