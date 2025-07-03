<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Desa
 *
 * @property $id
 * @property $kecamatan_id
 * @property $nama_desa
 * @property $klas
 * @property $stat_pem
 * @property $latitude
 * @property $longitude
 * @property $created_at
 * @property $updated_at
 *
 * @property Kecamatan $kecamatan
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Desa extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kecamatan_id', 'nama_desa', 'klas', 'stat_pem', 'latitude', 'longitude'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kecamatan()
    {
        return $this->belongsTo(\App\Models\Kecamatan::class, 'kecamatan_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function profileDesa()
    {
        return $this->hasOne(ProfileDesa::class, 'desa_id', 'id');
    }

    public function rtRwDesa()
    {
        return $this->hasOne(RtRwDesa::class, 'desa_id', 'id');
    }


    public function perangkatDesa()
    {
        return $this->hasMany(PerangkatDesa::class);
    }

    public function pendapatanDesa()
    {
        return $this->hasMany(PendapatanDesa::class);
    }

    public function kategoris()
    {
        return $this->hasMany(Kategori::class, 'asal_id');
    }
    // public function bpd()
    // {
    //     return $this->hasMany(BPD::class);
    // }

    public function kelembagaan()
    {
        return $this->hasMany(KelembagaanDesa::class);
    }

    public function lpmdk()
    {
        return $this->hasMany(Lpmdk::class);
    }

    public function pkk()
    {
        return $this->hasMany(PkkDesa::class);
    }

    public function bumdes()
    {
        return $this->hasMany(Bumde::class);
    }

    // public function infrastruktur()
    // {
    //     return $this->hasMany(Infrastruktur::class);
    // }

    // public function transparansi()
    // {
    //     return $this->hasMany(Transparansi::class);
    // }

    // public function programTidakMampu()
    // {
    //     return $this->hasMany(ProgramTidakMampu::class);
    // }

    public function jalanDesa()
    {
        return $this->hasMany(JalanDesa::class);
    }

    // public function irigasi()
    // {
    //     return $this->hasMany(irigasi::class);
    // }


    public function jalanKab()
    {
        return $this->hasMany(JalanKabupatenDesa::class);
    }

    public function jembatan()
    {
        return $this->hasMany(JembatanDesa::class);
    }

    // public function pasar()
    // {
    //     return $this->hasMany(pasar::class);
    // }

    // public function pembuanganSampah()
    // {
    //     return $this->hasMany(pembuangansampah::class);
    // }

    public function pendidikan()
    {
        return $this->hasMany(PendidikanDesa::class);
    }

    // public function pusatPerdagangan()
    // {
    //     return $this->hasMany(pusatperdagangan::class);
    // }

    // public function rumahPotongHewan()
    // {
    //     return $this->hasMany(rumahpotonghewan::class);
    // }

    public function SaranaIbadah()
    {
        return $this->hasMany(SaranaIbadahDesa::class);
    }
}
