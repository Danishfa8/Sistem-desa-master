<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'tipe'];

    /**
     * Relasi ke model KelembagaanDesa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelembagaanDesa()
    {
        return $this->hasMany(\App\Models\KelembagaanDesa::class, 'id_kategori', 'id');
    }
    public function EkonomiDesa()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function IndustriPenghasilanLimbahDesa()
    {
        return $this->hasMany(\App\Models\IndustriPenghasilLimbahDesa::class, 'id_kategori', 'id');
    }
    public function KerawananSosialDesa()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function SaranaLainya()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function TempatTinggal()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function SumberDayaAlam()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function Energi()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function Olahraga()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function SaranaPendukungKesehatan()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function SaranaKesehatan()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function Transportasi()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function UsahaEkonomi()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function ProdukUnggulan()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function Kebudayaan()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
    public function KondisiLingkungan()
    {
        return $this->hasMany(\App\Models\Ekonomi::class, 'id_kategori', 'id');
    }
}

