<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class ProfileDesaController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::all();
        $desas = Desa::with('kecamatan')->get();
        return view('web.profile', compact('kecamatans', 'desas'));
    }

    public function showDesa($kecamatan_id)
    {
        $desas = Desa::where('kecamatan_id', $kecamatan_id)->get();
        return response()->json($desas);
    }

    public function detailDesa($desa_id)
    {
        $desa = Desa::with([
            'kecamatan',
            'profilDesa',
            'perangkatDesa',
            'keuanganDesa',
            'bpd',
            'kelembagaan',
            'infrastruktur',
            'transparansi',
            'programTidakMampu'
        ])->findOrFail($desa_id);

        return response()->json($desa);
    }

    // Method untuk mengambil data section tertentu
    public function getDesaSection($desa_id, $section)
    {
        $desa = Desa::findOrFail($desa_id);

        switch ($section) {
            case 'profil-desa':
                $data = $desa->profileDesa;
                return view('web.partials.sections.profile', compact('data', 'desa'))->render();

            case 'perangkat-desa':
                $data = $desa->erangkatDesa;
                return view('web.partials.sections.perangkat', compact('data', 'desa'))->render();

            case 'keuangan':
                $data = $desa->pendapatanDesa;
                $totalPendapatan = $data->sum('jumlah_pendapatan');
                return view('web.partials.sections.keuangan', compact('data', 'desa', 'totalPendapatan'))->render();

            case 'bpd':
                $data = $desa->bpd;
                return view('web.partials.sections.bpd', compact('data', 'desa'))->render();

            case 'kelembagaan':
                $data = $desa->kelembagaan;
                $lpmdk = [
                    'jumlah_pengurus' => $desa->lpmdk->sum('jumlah_pengurus'),
                    'jumlah_kegiatan' => $desa->lpmdk->sum('jumlah_kegiatan'),
                    'jumlah_dana'     => $desa->lpmdk->sum('jumlah_dana'),
                ];
                $pkk = [
                    'jumlah_pengurus' => $desa->pkk->sum('jumlah_pengurus'),
                    'jumlah_anggota' => $desa->pkk->sum('jumlah_anggota'),
                    'jumlah_kegiatan' => $desa->pkk->sum('jumlah_kegiatan'),
                    'jumlah_buku_administrasi' => $desa->pkk->sum('jumlah_buku_administrasi'),
                    'jumlah_dana'     => $desa->pkk->sum('jumlah_dana'),

                ];
                $totalBumdes = $desa->bumdes()->count();
                return view('web.partials.sections.kelembagaan', compact('data', 'desa', 'lpmdk', 'pkk', 'totalBumdes'))->render();

            case 'infrastruktur':
                $data = $desa->infrastruktur;
                return view('web.partials.sections.infrastruktur', compact('data', 'desa'))->render();

            case 'transparansi':
                $data = $desa->transparansi;
                return view('web.partials.sections.transparansi', compact('data', 'desa'))->render();

            case 'program-tidak-mampu':
                $data = $desa->programTidakMampu;
                return view('web.partials.sections.program-tidak-mampu', compact('data', 'desa'))->render();

            default:
                return response()->json(['error' => 'Section tidak ditemukan'], 404);
        }
    }
}
