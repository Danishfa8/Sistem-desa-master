<?php

namespace App\Http\Controllers\AdminKabupaten;

use App\Http\Controllers\Controller;
use App\Models\Bumde;
use App\Models\Desa;
use App\Models\JalanDesa;
use App\Models\JalanKabupatenDesa;
use App\Models\JembatanDesa;
use App\Models\Kecamatan;
use App\Models\KelembagaanDesa;
use App\Models\Lpmdk;
use App\Models\PendapatanDesa;
use App\Models\PerangkatDesa;
use App\Models\PkkDesa;
use App\Models\ProfileDesa;
use App\Models\RtRwDesa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin_kabupaten.dashboard');
    }

    public function kecamatan(Request $request): View
    {
        $kecamatans = Kecamatan::paginate();

        return view('admin_kabupaten.kecamatan', compact('kecamatans'))
            ->with('i', ($request->input('page', 1) - 1) * $kecamatans->perPage());
    }

    public function desa(Request $request): View
    {
        $desas = Desa::with('kecamatan', 'profileDesa')->paginate();
        // $profileDesa = ProfileDesa::all();

        return view('admin_kabupaten.desa', compact('desas'))
            ->with('i', ($request->input('page', 1) - 1) * $desas->perPage());
    }

    public function profileDesa(Request $request): View
    {
        $profileDesas = ProfileDesa::paginate();

        return view('admin_kabupaten.profile-desa', compact('profileDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $profileDesas->perPage());
    }

    public function rtRwDesa(Request $request): View
    {
        $rtRwDesas = RtRwDesa::with('desa')->paginate();

        return view('admin_kabupaten.rt-rw', compact('rtRwDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $rtRwDesas->perPage());
    }

    public function perangkatDesa(Request $request): View
    {
        $perangkatDesas = PerangkatDesa::with('desa')->paginate();

        return view('admin_kabupaten.perangkat-desa', compact('perangkatDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $perangkatDesas->perPage());
    }

    public function pendapatanDesa(Request $request): View
    {
        $pendapatanDesas = PendapatanDesa::with('desa')->paginate();

        return view('admin_kabupaten.pendapatan', compact('pendapatanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $pendapatanDesas->perPage());
    }
}
