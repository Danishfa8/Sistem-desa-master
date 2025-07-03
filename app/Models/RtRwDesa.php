<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RtRwDesa
 *
 * @property $id
 * @property $desa_id
 * @property $rt
 * @property $rw
 * @property $created_at
 * @property $updated_at
 *
 * @property Desa $desa
 * @property BalitaDesa[] $balitaDesas
 * @property DisabilitasDesa[] $disabilitasDesas
 * @property EnergiDesa[] $energiDesas
 * @property IndustriPenghasilLimbahDesa[] $industriPenghasilLimbahDesas
 * @property IrigasiDesa[] $irigasiDesas
 * @property JalanDesa[] $jalanDesas
 * @property JalanKabupatenDesa[] $jalanKabupatenDesas
 * @property JembatanDesa[] $jembatanDesas
 * @property KebudayaanDesa[] $kebudayaanDesas
 * @property KelembagaanDesa[] $kelembagaanDesas
 * @property KerawananSosialDesa[] $kerawananSosialDesas
 * @property KondisiLingkunganKeluargaDesa[] $kondisiLingkunganKeluargaDesas
 * @property LansiaDesa[] $lansiaDesas
 * @property OlahragaDesa[] $olahragaDesas
 * @property PasarDesa[] $pasarDesas
 * @property PelakuUmkmDesa[] $pelakuUmkmDesas
 * @property PembuanganSampahDesa[] $pembuanganSampahDesas
 * @property PendidikanDesa[] $pendidikanDesas
 * @property ProdukUnggulanDesa[] $produkUnggulanDesas
 * @property PusatPerdaganganDesa[] $pusatPerdaganganDesas
 * @property RumahPotongHewanDesa[] $rumahPotongHewanDesas
 * @property SaranaIbadahDesa[] $saranaIbadahDesas
 * @property SaranaKesehatanDesa[] $saranaKesehatanDesas
 * @property SaranaLainyaDesa[] $saranaLainyaDesas
 * @property SaranaPendukungKesehatanDesa[] $saranaPendukungKesehatanDesas
 * @property SumberDayaAlamDesa[] $sumberDayaAlamDesas
 * @property TempatTinggalDesa[] $tempatTinggalDesas
 * @property TransportasiDesa[] $transportasiDesas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RtRwDesa extends Model
{

    use HasFactory;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['desa_id', 'rt', 'rw'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function getRtRwAttribute()
    {
        return 'RT ' . $this->rt . ' / RW ' . $this->rw;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(\App\Models\Desa::class, 'desa_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balitaDesas()
    {
        return $this->hasMany(\App\Models\BalitaDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disabilitasDesas()
    {
        return $this->hasMany(\App\Models\DisabilitasDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function energiDesas()
    {
        return $this->hasMany(\App\Models\EnergiDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industriPenghasilLimbahDesas()
    {
        return $this->hasMany(\App\Models\IndustriPenghasilLimbahDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function irigasiDesas()
    {
        return $this->hasMany(\App\Models\IrigasiDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jalanDesas()
    {
        return $this->hasMany(\App\Models\JalanDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jalanKabupatenDesas()
    {
        return $this->hasMany(\App\Models\JalanKabupatenDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jembatanDesas()
    {
        return $this->hasMany(\App\Models\JembatanDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kebudayaanDesas()
    {
        return $this->hasMany(\App\Models\KebudayaanDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelembagaanDesas()
    {
        return $this->hasMany(\App\Models\KelembagaanDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kerawananSosialDesas()
    {
        return $this->hasMany(\App\Models\KerawananSosialDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kondisiLingkunganKeluargaDesas()
    {
        return $this->hasMany(\App\Models\KondisiLingkunganKeluargaDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lansiaDesas()
    {
        return $this->hasMany(\App\Models\LansiaDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function olahragaDesas()
    {
        return $this->hasMany(\App\Models\OlahragaDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pasarDesas()
    {
        return $this->hasMany(\App\Models\PasarDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pelakuUmkmDesas()
    {
        return $this->hasMany(\App\Models\PelakuUmkmDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembuanganSampahDesas()
    {
        return $this->hasMany(\App\Models\PembuanganSampahDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pendidikanDesas()
    {
        return $this->hasMany(\App\Models\PendidikanDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produkUnggulanDesas()
    {
        return $this->hasMany(\App\Models\ProdukUnggulanDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pusatPerdaganganDesas()
    {
        return $this->hasMany(\App\Models\PusatPerdaganganDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rumahPotongHewanDesas()
    {
        return $this->hasMany(\App\Models\RumahPotongHewanDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saranaIbadahDesas()
    {
        return $this->hasMany(\App\Models\SaranaIbadahDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saranaKesehatanDesas()
    {
        return $this->hasMany(\App\Models\SaranaKesehatanDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saranaLainyaDesas()
    {
        return $this->hasMany(\App\Models\SaranaLainyaDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saranaPendukungKesehatanDesas()
    {
        return $this->hasMany(\App\Models\SaranaPendukungKesehatanDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sumberDayaAlamDesas()
    {
        return $this->hasMany(\App\Models\SumberDayaAlamDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tempatTinggalDesas()
    {
        return $this->hasMany(\App\Models\TempatTinggalDesa::class, 'id', 'rt_rw_desa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transportasiDesas()
    {
        return $this->hasMany(\App\Models\TransportasiDesa::class, 'id', 'rt_rw_desa_id');
    }
}
