<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\KategoriPeta;
use App\Models\JembatanDesa;
use App\Models\PendidikanDesa;

class DataDalamPetaController extends Controller
{
    public function index(Request $request)
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        $desas = Desa::with('kecamatan')->orderBy('nama_desa')->get();
        $kategoriPeta = KategoriPeta::orderBy('nama')->get();

        $selectedKecamatan = $request->get('kecamatan');
        $selectedDesa = $request->get('desa');
        $selectedKategori = $request->get('kategori');

        $viewPeta = null;
        $jembatanMarkers = [];
        $pendidikanMarkers = [];
        $desaLat = null;
        $desaLng = null;

        if ($selectedKecamatan && $selectedDesa) {
            $desa = Desa::where('id', $selectedDesa)
                        ->where('kecamatan_id', $selectedKecamatan)
                        ->first();

            if ($desa) {
                $desaLat = $desa->latitude;
                $desaLng = $desa->longitude;

                if ($selectedKategori == 9) {
                    // Peta jembatan
                    $viewPeta = 'web.partials.peta-jembatan';

                    $jembatanMarkers = JembatanDesa::with('desa')
                        ->where('desa_id', $selectedDesa)
                        ->where('status', 'Approved')
                        ->whereNotNull('latitude')
                        ->whereNotNull('longitude')
                        ->get();
                }

                if ($selectedKategori == 6) {
                    // Peta pendidikan
                    $viewPeta = 'web.partials.peta-pendidikan';

                    $pendidikanMarkers = PendidikanDesa::with('desa')
                        ->where('desa_id', $selectedDesa)
                        ->where('status', 'Approved')
                        ->whereNotNull('latitude')
                        ->whereNotNull('longitude')
                        ->get();
                }
            }
        }

        return view('web.data-peta', compact(
            'kecamatans',
            'desas',
            'kategoriPeta',
            'selectedKecamatan',
            'selectedDesa',
            'selectedKategori',
            'viewPeta',
            'jembatanMarkers',
            'pendidikanMarkers',
            'desaLat',
            'desaLng'
        ));
    }
}
