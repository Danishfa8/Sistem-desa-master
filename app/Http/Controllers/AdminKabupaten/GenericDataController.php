<?php

namespace App\Http\Controllers\AdminKabupaten;

use App\Http\Controllers\Controller;
use App\Models\BalitaDesa;
use App\Models\Bumde;
use App\Models\Desa;
use App\Models\DisabilitasDesa;
use App\Models\Ekonomi;
use App\Models\EnergiDesa;
use App\Models\IndustriPenghasilLimbahDesa;
use App\Models\JalanDesa;
use App\Models\JalanKabupatenDesa;
use App\Models\JembatanDesa;
use App\Models\KelembagaanDesa;
use App\Models\KondisiLingkunganKeluargaDesa;
use App\Models\LansiaDesa;
use App\Models\Lpmdk;
use App\Models\OlahragaDesa;
use App\Models\PelakuUmkmDesa;
use App\Models\PendidikanDesa;
use App\Models\Pengeluaran;
use App\Models\PkkDesa;
use App\Models\ProfileDesa;
use App\Models\RtRwDesa;
use App\Models\SaranaIbadahDesa;
use App\Models\SaranaKesehatanDesa;
use App\Models\SaranaLainyaDesa;
use App\Models\SaranaPendukungKesehatanDesa;
use App\Models\SumberDayaAlamDesa;
use App\Models\TempatTinggalDesa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GenericDataController extends Controller
{
    private array $config = [
        // 'desa' => [
        //     'model' => Desa::class,
        //     'view' => 'admin_kabupaten.desa',
        //     'variable' => 'desas'
        // ],
        // 'profile-desa' => [
        //     'model' => ProfileDesa::class,
        //     'view' => 'admin_kabupaten.profile-desa',
        //     'variable' => 'profileDesas'
        // ],

        // 'rt-rw-desa' => [
        //     'model' => RtRwDesa::class,
        //     'view' => 'admin_kabupaten.rt-rw-desa',
        //     'variable' => 'rtRwDesas'
        // ],


        'kelembagaan-desa' => [
            'model' => KelembagaanDesa::class,
            'view' => 'admin_kabupaten.kelembagaan',
            'variable' => 'kelembagaanDesas'
        ],
        'bumdes' => [
            'model' => Bumde::class,
            'view' => 'admin_kabupaten.bumdes',
            'variable' => 'bumdes'
        ],
        'lpmdk' => [
            'model' => Lpmdk::class,
            'view' => 'admin_kabupaten.lpmdk',
            'variable' => 'lpmdks'
        ],
        'pkk-desa' => [
            'model' => PkkDesa::class,
            'view' => 'admin_kabupaten.pkk-desa',
            'variable' => 'pkkDesas'
        ],
        'jembatan-desa' => [
            'model' => JembatanDesa::class,
            'view' => 'admin_kabupaten.jembatan-desa',
            'variable' => 'jembatanDesas'
        ],
        'jalan-desa' => [
            'model' => JalanDesa::class,
            'view' => 'admin_kabupaten.jalan',
            'variable' => 'jalanDesas'
        ],
        'jalan-kabupaten-desa' => [
            'model' => JalanKabupatenDesa::class,
            'view' => 'admin_kabupaten.jalan-kabupaten-desa',
            'variable' => 'jalanKabupatenDesas'
        ],
        'kerawanan-sosial-desa' => [
            'model' => JalanKabupatenDesa::class,
            'view' => 'admin_kabupaten.kerawanan-sosial-desa',
            'variable' => 'kerawananSosialDesas'
        ],
        'kondisi-lingkungan-keluarga-desa' => [
            'model' => KondisiLingkunganKeluargaDesa::class,
            'view' => 'admin_kabupaten.kondisi-lingkungan-keluarga-desa',
            'variable' => 'kondisiLingkunganKeluargaDesas'
        ],
        'tempat-tinggal-desa' => [
            'model' => TempatTinggalDesa::class,
            'view' => 'admin_kabupaten.tempat-tinggal-desa',
            'variable' => 'tempatTinggalDesas'
        ],
        'disabilitas-desa' => [
            'model' => DisabilitasDesa::class,
            'view' => 'admin_kabupaten.disabilitas-desa',
            'variable' => 'disabilitasDesas'
        ],
        'balita-desa' => [
            'model' => BalitaDesa::class,
            'view' => 'admin_kabupaten.balita-desa',
            'variable' => 'balitaDesas'
        ],
        'lansia-desa' => [
            'model' => LansiaDesa::class,
            'view' => 'admin_kabupaten.lansia-desa',
            'variable' => 'lansiaDesas'
        ],
        'pendidikan-desa' => [
            'model' => PendidikanDesa::class,
            'view' => 'admin_kabupaten.pendidikan-desa',
            'variable' => 'pendidikanDesas'
        ],
        'olahraga-desa' => [
            'model' => OlahragaDesa::class,
            'view' => 'admin_kabupaten.olahraga-desa',
            'variable' => 'olahragaDesas'
        ],
        'pelaku-umkm-desa' => [
            'model' => PelakuUmkmDesa::class,
            'view' => 'admin_kabupaten.pelaku-umkm-desa',
            'variable' => 'pelakuUmkmDesas'
        ],
        'sarana-kesehatan-desa' => [
            'model' => SaranaKesehatanDesa::class,
            'view' => 'admin_kabupaten.sarana-kesehatan-desa',
            'variable' => 'saranaKesehatanDesas'
        ],
        'sarana-pendukung-kesehatan-desa' => [
            'model' => SaranaPendukungKesehatanDesa::class,
            'view' => 'admin_kabupaten.sarana-pendukung-kesehatan-desa',
            'variable' => 'saranaPendukungKesehatanDesas'
        ],
        'sarana-ibadah-desa' => [
            'model' => SaranaIbadahDesa::class,
            'view' => 'admin_kabupaten.sarana-ibadah-desa',
            'variable' => 'saranaIbadahDesas'
        ],
        'sarana-lainya-desa' => [
            'model' => SaranaLainyaDesa::class,
            'view' => 'admin_kabupaten.sarana-lainya-desa',
            'variable' => 'saranaLainyaDesas'
        ],
        'industri-penghasil-limbah-desa' => [
            'model' => IndustriPenghasilLimbahDesa::class,
            'view' => 'admin_kabupaten.industri-penghasil-limbah-desa',
            'variable' => 'industriPenghasilLimbahDesas'
        ],
        'energi-desa' => [
            'model' => EnergiDesa::class,
            'view' => 'admin_kabupaten.energi-desa',
            'variable' => 'energiDesas'
        ],
        'sumber-daya-alam-desa' => [
            'model' => SumberDayaAlamDesa::class,
            'view' => 'admin_kabupaten.sumber-daya-alam-desa',
            'variable' => 'sumberDayaAlamDesas'
        ],
        'pengeluaran' => [
            'model' => Pengeluaran::class,
            'view' => 'admin_kabupaten.pengeluaran',
            'variable' => 'pengeluarans'
        ],
        'ekonomi' => [
            'model' => Ekonomi::class,
            'view' => 'admin_kabupaten.ekonomi',
            'variable' => 'ekonomis'
        ],
        'usaha-ekonomi' => [
            'model' => Pengeluaran::class,
            'view' => 'admin_kabupaten.usaha-ekonomi',
            'variable' => 'usahaEkonomis'
        ],



    ];


    public function show(Request $request, string $type = null): View
    {
        // Jika type tidak ada di parameter, ambil dari route defaults
        if (!$type) {
            $type = $request->route()->parameter('type');
        } {
            // Validasi type
            if (!array_key_exists($type, $this->config)) {
                abort(404, 'Data type not found');
            }

            $config = $this->config[$type];
            $model = $config['model'];

            $data = $model::with('desa', 'rtRwDesa')->paginate();

            return view($config['view'], [$config['variable'] => $data])
                ->with('i', ($request->input('page', 1) - 1) * $data->perPage());
        }
    }
}
