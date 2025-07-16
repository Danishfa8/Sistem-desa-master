<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Ekonomi;
use App\Models\EnergiDesa;
use App\Models\IndustriPenghasilLimbahDesa;
use App\Models\Kebudayaan;
use App\Models\Kecamatan;
use App\Models\KelembagaanDesa;
use App\Models\KerawananSosialDesa;
use App\Models\KondisiLingkunganKeluargaDesa;
use App\Models\OlahragaDesa;
use App\Models\ProdukUnggulan;
use App\Models\SaranaKesehatanDesa;
use App\Models\SaranaLainyaDesa;
use App\Models\SaranaPendukungKesehatanDesa;
use App\Models\SumberDayaAlamDesa;
use App\Models\TempatTinggalDesa;
use App\Models\Transportasi;
use App\Models\UsahaEkonomi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = \App\Models\User::count();
        $desaCount = \App\Models\Desa::count();
        $kecamatanCount = \App\Models\Kecamatan::count();

        $tableCounts = [
            'Ekonomi' => \App\Models\Ekonomi::count(),
            'Usaha Ekonomi' => \App\Models\UsahaEkonomi::count(),
            'Energi' => \App\Models\EnergiDesa::count(),
            'Industri Limbah' => \App\Models\IndustriPenghasilLimbahDesa::count(),
            'Kelembagaan' => \App\Models\KelembagaanDesa::count(),
            'Kerawanan Sosial' => \App\Models\KerawananSosialDesa::count(),
            'Lingkungan Keluarga' => \App\Models\KondisiLingkunganKeluargaDesa::count(),
            'Olahraga' => \App\Models\OlahragaDesa::count(),
            'Produk Unggulan' => \App\Models\ProdukUnggulan::count(),
            'Sarana Kesehatan' => \App\Models\SaranaKesehatanDesa::count(),
            'Sarana Lainnya' => \App\Models\SaranaLainyaDesa::count(),
            'Pendukung Kesehatan' => \App\Models\SaranaPendukungKesehatanDesa::count(),
            'Sumber Daya Alam' => \App\Models\SumberDayaAlamDesa::count(),
            'Transportasi' => \App\Models\Transportasi::count(),
            'Tempat Tinggal' => \App\Models\TempatTinggalDesa::count()
        ];

        $totalData = array_sum($tableCounts);

        return view('superadmin.home.index', compact('userCount', 'desaCount', 'kecamatanCount', 'totalData', 'tableCounts'));
    }
}
