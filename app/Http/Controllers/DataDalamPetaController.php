<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\KategoriPeta;
use App\Models\BalitaDesa;
use App\Models\LansiaDesa;
use App\Models\DisabilitasDesa;
use App\Models\PelakuUmkmDesa;
use App\Models\PendidikanDesa;
use App\Models\SaranaIbadahDesa;
use App\Models\JembatanDesa;
class DataDalamPetaController extends Controller
{
    public function index()
    {
        return view('web.data-peta', [
            'kategoriPeta' => KategoriPeta::all(),
            'kecamatans' => Kecamatan::all()
        ]);
    }

    public function getTahun($kategori, Request $request)
    {
        $desaIds = Desa::where('kecamatan_id', $request->kecamatan_id)->pluck('id');

        $model = match ((int) $kategori) {
            1 => BalitaDesa::class,
            2 => LansiaDesa::class,
            3 => PelakuUmkmDesa::class,
            4 => DisabilitasDesa::class,
            default => null,
        };

        if (!$model) return response()->json([]);

        return response()->json(
            $model::whereIn('desa_id', $desaIds)
                ->where('status', 'Approved')
                ->distinct()
                ->orderBy('tahun', 'desc')
                ->pluck('tahun')
        );
    }

    public function getGeojson(Request $request)
    {
        $kategori = (int) $request->kategori;
        $tahun = $request->tahun;
        $kecamatan_id = $request->kecamatan_id;

        $model = match ($kategori) {
            1 => [BalitaDesa::class, 'jumlah_balita'],
            2 => [LansiaDesa::class, 'jumlah_lansia'],
            3 => [PelakuUmkmDesa::class, 'jumlah_umkm'],
            4 => [DisabilitasDesa::class, 'jumlah'],
            default => null,
        };

        if (!$model) return response()->json([]);

        $desas = Desa::where('kecamatan_id', $kecamatan_id)->whereNotNull('geojson')->get();

        $features = [];

        foreach ($desas as $desa) {
            $jumlah = $model[0]::where('desa_id', $desa->id)
                ->where('status', 'Approved')
                ->when($tahun, fn($q) => $q->where('tahun', $tahun))
                ->sum($model[1]);

            $features[] = [
                'type' => 'Feature',
                'properties' => [
                    'desa' => $desa->nama_desa,
                    'id' => $desa->id,
                    $model[1] => $jumlah
                ],
                'geometry' => json_decode($desa->geojson)
            ];
        }

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }

    public function getDetailDesa(Request $request)
    {
        $desaId = $request->desa_id;
        $kategori = (int) $request->kategori;
        $tahun = $request->tahun;

        $model = match ($kategori) {
            1 => [BalitaDesa::class, 'jumlah_balita', 'Balita'],
            2 => [LansiaDesa::class, 'jumlah_lansia', 'Lansia'],
            3 => [PelakuUmkmDesa::class, 'jumlah_umkm', 'UMKM'],
            4 => [DisabilitasDesa::class, 'jumlah', 'Disabilitas'],
            default => null
        };

        if (!$model) return response()->json([]);

        $records = $model[0]::with('rtRwDesa')
            ->where('desa_id', $desaId)
            ->where('status', 'Approved')
            ->when($tahun, fn($q) => $q->where('tahun', $tahun))
            ->get();

        $total = $records->sum($model[1]);

        $grouped = $records->groupBy(fn($d) => $d->rtRwDesa->rw ?? '-');

        $result = [];
        foreach ($grouped as $rw => $items) {
            $result[$rw] = $items->map(function ($item) use ($model, $kategori) {
                return [
                    'jumlah' => $item->{$model[1]},
                    'rt_rw_desa' => $item->rtRwDesa,
                    'jenis' => $kategori === 4 ? $item->jenis_disabilitas : null,
                ];
            });
        }

        $desa = Desa::with('kecamatan')->find($desaId);
        return response()->json([
            'desa' => $desa?->nama_desa ?? '',
            'kecamatan' => $desa?->kecamatan?->nama_kecamatan ?? '',
            'tahun' => $tahun,
            'kategori_nama' => $model[2],
            'total' => $total,
            'data' => $result
        ]);
    }
    public function getMarkerData(Request $request)
    {
        $kategori = (int) $request->kategori;
        $desa_id = $request->desa_id;
    
        $model = match ($kategori) {
            6 => PendidikanDesa::class,
            8 => SaranaIbadahDesa::class,
            9 => JembatanDesa::class,
            default => null,
        };
    
        if (!$model || !$desa_id) {
            return response()->json([]);
        }
    
        $data = $model::with(['desa', 'rtRwDesa'])
            ->where('desa_id', $desa_id)
            ->where('status', 'Approved')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();
    
$features = $data->map(function ($item) use ($kategori) {
    $jenis = $item->jenis_sarana_ibadah ?? $item->jenis_pendidikan ?? $item->jenis_jembatan ?? '-';

    $icon = match ($kategori) {
        6 => asset('assets/icons/sekolah.ico'),
        9 => asset('assets/icons/jembatan.png'),
        8 => match ($jenis) {
            'Masjid' => asset('assets/icons/masjid.png'),
            'Mushola' => asset('assets/icons/masjid.png'),
            'Gereja' => asset('assets/icons/gereja.png'),
            'Pura' => asset('assets/icons/pura.png'),
            'Vihara' => asset('assets/icons/vihara.png'),
            'Kelenteng' => asset('assets/icons/kelenteng.png'),
            'Kantor Lembaga Keagamaan' => asset('assets/icons/kantoragama.png'),
            default => asset('assets/icons/masjid.png'),
        },
        default => null
    };

    return [
        'id' => $item->id,
        'lat' => $item->latitude,
        'lng' => $item->longitude,
        'nama' => $item->nama_pendidikan ?? $item->nama ?? 'N/A',
        'jenis' => $jenis,
        'rt' => $item->rtRwDesa->rt ?? '-',
        'rw' => $item->rtRwDesa->rw ?? '-',
        'foto' => $item->foto ?? null,
        'icon' => $icon,
    ];
});

    
        return response()->json($features);
    }

    public function getDesa($kecamatan_id)
{
    $desas = Desa::where('kecamatan_id', $kecamatan_id)->select('id', 'nama_desa')->get();
    return response()->json($desas);
}

public function getMarkerDetail(Request $request)
{
    $kategori = (int) $request->kategori;
    $id = $request->id;

    $model = match ($kategori) {
        6 => PendidikanDesa::class,
        8 => SaranaIbadahDesa::class,
        9 => JembatanDesa::class,
        default => null,
    };

    if (!$model) return response()->json([]);

    $item = $model::with(['desa.kecamatan', 'rtRwDesa'])->find($id);
    if (!$item) return response()->json([]);

    // Kategori Jembatan
    if ($kategori === 9) {
        return response()->json([
            'nama' => $item->nama_jembatan,
            'panjang' => $item->panjang,
            'lebar' => $item->lebar,
            'kondisi' => $item->kondisi,
            'lokasi' => $item->lokasi,
            'rt' => $item->rtRwDesa->rt ?? '-',
            'rw' => $item->rtRwDesa->rw ?? '-',
            'desa' => $item->desa->nama_desa ?? '-',
            'kecamatan' => $item->desa->kecamatan->nama_kecamatan ?? '-',
            'foto' => $item->foto,
        ]);
    }elseif ($kategori === 6) {
        // ✅ Pendidikan
        return response()->json([
            'nama' => $item->nama_pendidikan ?? '-',
            'jenis' => $item->jenis_pendidikan ?? '-',
            'status' => $item->status_pendidikan ?? '-',
            'rt' => $item->rtRwDesa->rt ?? '-',
            'rw' => $item->rtRwDesa->rw ?? '-',
            'desa' => $item->desa->nama_desa ?? '-',
            'kecamatan' => $item->desa->kecamatan->nama_kecamatan ?? '-',
            'foto' => $item->foto,
        ]);
    } elseif ($kategori === 8) {
        return response()->json([
            'nama' => $item->nama_sarana_ibadah ?? '-',
            'jenis' => $item->jenis_sarana_ibadah ?? '-',
            'rt' => $item->rtRwDesa->rt ?? '-',
            'rw' => $item->rtRwDesa->rw ?? '-',
            'desa' => $item->desa->nama_desa ?? '-',
            'kecamatan' => $item->desa->kecamatan->nama_kecamatan ?? '-',
            'foto' => $item->foto,
        ]);
    }



    // Default pendidikan / ibadah
    return response()->json([
        'nama' => $item->nama_pendidikan ?? $item->nama ?? '-',
        'jenis' => $item->jenis_pendidikan ?? $item->jenis_ibadah ?? '-',
        'rt' => $item->rtRwDesa->rt ?? '-',
        'rw' => $item->rtRwDesa->rw ?? '-',
        'desa' => $item->desa->nama_desa ?? '-',
        'kecamatan' => $item->desa->kecamatan->nama_kecamatan ?? '-',
        'foto' => $item->foto,
    ]);
}


}
