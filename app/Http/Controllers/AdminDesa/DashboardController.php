<?php

namespace App\Http\Controllers\admindesa;

use App\Http\Controllers\Controller;
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

        return view('admin_desa.home.index', compact('userCount', 'desaCount', 'kecamatanCount', 'totalData', 'tableCounts'));
    }
}
