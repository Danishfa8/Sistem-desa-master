

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Kecamatan;
// use App\Models\Desa;
// use App\Models\ProfileDesa;
// use App\Models\PerangkatDesa;
// use App\Models\PendapatanDesa;
// use App\Models\Pengeluaran;
// use App\Models\Lpmdk;
// use App\Models\PkkDesa;
// use App\Models\Bumde;
// use Barryvdh\DomPDF\Facade\Pdf;

// class BukuDesaController extends Controller
// {
//     public function index()
//     {
//         $kecamatans = Kecamatan::all();
//         $desas = Desa::all();
//         return view('web.buku-desa', compact('kecamatans', 'desas'));
//     }
    
    // public function getData(Request $request)
    // {
    //     $desa = Desa::find($request->desa);
    //     $kecamatan = Kecamatan::find($request->kecamatan);
    
    //     $html = view('web.partials.preview-buku', [
    //         'tahun' => $request->tahun,
    //         'desa' => $desa,
    //         'kecamatan' => $kecamatan,
    //     ])->render();
    
    //     return response()->json(['html' => $html]);
    // }
    

//     public function generatePdf(Request $request)
//     {
//         $tahun = $request->tahun;
//         $desa = Desa::findOrFail($request->desa);
//         $kecamatan = Kecamatan::findOrFail($request->kecamatan);
//         $profileDesa = ProfileDesa::where('desa_id', $desa->id)->first();
//         $perangkatDesa = PerangkatDesa::where('desa_id', $desa->id)->get();
//         $pendapatanDesa = PendapatanDesa::where('desa_id', $desa->id)->get();
// $pengeluaranDesa = Pengeluaran::where('desa_id', $desa->id)->get();
// $lpmdk = Lpmdk::where('desa_id', $desa->id)->first();
// $pkkDesa = PkkDesa::where('desa_id', $desa->id)->first();
// $bumdes = Bumde::where('desa_id', $desa->id)->first();
    
//         $pdf = PDF::loadView('web.pdf.template-buku-desa', [
//             'tahun' => $tahun,
//             'desa' => $desa,
//             'kecamatan' => $kecamatan,
//             'profileDesa' => $profileDesa,
//             'perangkatDesa' => $perangkatDesa,
//             'pendapatanDesa' => $pendapatanDesa,
//             'pengeluaranDesa' => $pengeluaranDesa,
//             'lpmdk' => $lpmdk,
//             'pkkDesa' => $pkkDesa,
//             'bumdes' => $bumdes,
//         ])->setPaper('A4', 'portrait');
    
//         return $pdf->stream("Buku-Desa-{$desa->nama_desa}-{$tahun}.pdf");
//     }
    
//     public function downloadPdf(Request $request)
//     {
//         $tahun = $request->tahun;
//         $desa = Desa::findOrFail($request->desa);
//         $kecamatan = Kecamatan::findOrFail($request->kecamatan);
//         $profileDesa = ProfileDesa::where('desa_id', $desa->id)->first();
//         $perangkatDesa = PerangkatDesa::where('desa_id', $desa->id)->get();
//         $pendapatanDesa = PendapatanDesa::where('desa_id', $desa->id)->get();
// $pengeluaranDesa = Pengeluaran::where('desa_id', $desa->id)->get();
// $lpmdk = Lpmdk::where('desa_id', $desa->id)->first();
// $pkkDesa = PkkDesa::where('desa_id', $desa->id)->first();
// $bumdes = Bumde::where('desa_id', $desa->id)->first();
//         $pdf = PDF::loadView('web.pdf.template-buku-desa', [
//             'tahun' => $tahun,
//             'desa' => $desa,
//             'kecamatan' => $kecamatan,
//             'profileDesa' => $profileDesa,
//             'perangkatDesa' => $perangkatDesa,
//             'pendapatanDesa' => $pendapatanDesa,
//             'pengeluaranDesa' => $pengeluaranDesa,
//             'lpmdk' => $lpmdk,
//             'pkkDesa' => $pkkDesa,
//             'bumdes' => $bumdes,
//         ])->setPaper('A4', 'portrait'); 
    
//         return $pdf->download("Buku-Desa-{$desa->nama_desa}-{$tahun}.pdf");
//     }
    
    
// }
