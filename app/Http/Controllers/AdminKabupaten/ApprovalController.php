<?php

namespace App\Http\Controllers\AdminKabupaten;

use App\Http\Controllers\Controller;
use App\Http\Requests\LansiaDesaRequest;
use App\Models\BalitaDesa;
use App\Models\Bumde;
use App\Models\DisabilitasDesa;
use App\Models\Ekonomi;
use App\Models\EnergiDesa;
use App\Models\IndustriPenghasilLimbahDesa;
use App\Models\JalanDesa;
use App\Models\JalanKabupatenDesa;
use App\Models\JembatanDesa;
use App\Models\KelembagaanDesa;
use App\Models\KerawananSosialDesa;
use App\Models\KondisiLingkunganKeluargaDesa;
use App\Models\LansiaDesa;
use App\Models\Lpmdk;
use App\Models\OlahragaDesa;
use App\Models\PelakuUmkmDesa;
use App\Models\PendidikanDesa;
use App\Models\Pengeluaran;
use App\Models\PkkDesa;
use App\Models\SaranaIbadahDesa;
use App\Models\SaranaKesehatanDesa;
use App\Models\SaranaLainyaDesa;
use App\Models\SaranaPendukungKesehatanDesa;
use App\Models\SumberDayaAlamDesa;
use App\Models\TempatTinggalDesa;
use App\Models\UsahaEkonomi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApprovalController extends Controller
{
    private $tableModelMap = [
        'kelembagaan_desas' => KelembagaanDesa::class,
        'bumdes' => Bumde::class,
        'lpmdks' => Lpmdk::class,
        'pkk_desas' => PkkDesa::class,
        'jembatan_desas' => JembatanDesa::class,
        'jalan_desas' => JalanDesa::class,
        'jalan_kabupaten_desas' => JalanKabupatenDesa::class,
        'kerawanan_sosial_desas' => KerawananSosialDesa::class,
        'kondisi_lingkungan_keluarga_desas' => KondisiLingkunganKeluargaDesa::class,
        'tempat_tinggal_desas' => TempatTinggalDesa::class,
        'disabilitas_desas' => DisabilitasDesa::class,
        'balita_desas' => BalitaDesa::class,
        'lansia_desas' => LansiaDesa::class,
        'pendidikan_desas' => PendidikanDesa::class,
        'olahraga_desas' => OlahragaDesa::class,
        'pelaku_umkm_desas' => PelakuUmkmDesa::class,
        'sarana_kesehatan_desas' => SaranaKesehatanDesa::class,
        'sarana_pendukung_kesehatan_desas' => SaranaPendukungKesehatanDesa::class,
        'sarana_ibadah_desas' => SaranaIbadahDesa::class,
        'sarana_lainya_desas' => SaranaLainyaDesa::class,
        'industri_penghasil_limbah_desas' => IndustriPenghasilLimbahDesa::class,
        'energi_desas' => EnergiDesa::class,
        'sumber_daya_alam_desas' => SumberDayaAlamDesa::class,
        'pengeluarans' => Pengeluaran::class,
        'ekonomis' => Ekonomi::class,
        'usaha_ekonomis' => UsahaEkonomi::class,
    ];

    /**
     * Approve atau reject data
     */
    public function approve(Request $request, $table = null, $id = null)
    {
        // Log untuk debugging
        Log::info('Approval started', [
            'table' => $table,
            'id' => $id,
            'status' => $request->status,
            'user' => Auth::user()->name ?? 'Unknown'
        ]);

        // Jika table tidak ada di parameter, ambil dari route defaults
        if (!$table) {
            $table = $request->route()->defaults['table'] ?? null;
        }

        $request->validate(
            [
                'status' => 'required|in:Approved,Rejected',
                'reject_reason' => 'required_if:status,Rejected|nullable|string|max:1000',
            ],
            [
                'status.required' => 'Status approval harus dipilih',
                'status.in' => 'Status approval harus Approved atau Rejected',
                'reject_reason.required_if' => 'Alasan penolakan wajib diisi jika status Rejected',
            ]
        );

        try {
            // Validasi tabel
            if (!isset($this->tableModelMap[$table])) {
                Log::error('Invalid table', ['table' => $table]);
                return back()->with('error', 'Tabel tidak valid');
            }

            $modelClass = $this->tableModelMap[$table];
            $record = $modelClass::findOrFail($id);

            Log::info('Record found', [
                'current_status' => $record->status,
                'record_id' => $record->id
            ]);

            // Validasi status saat ini
            if ($record->status !== 'Pending') {
                Log::warning('Record already processed', [
                    'current_status' => $record->status,
                    'record_id' => $record->id
                ]);
                return back()->with('error', 'Data sudah diproses sebelumnya');
            }

            // Update data
            $updateData = [
                'status' => $request->status,
                'updated_by' => Auth::user()->name,
                'approved_by' => Auth::user()->name,
                'approved_at' => Carbon::now(),
            ];

            if ($request->status === 'Rejected') {
                $updateData['reject_reason'] = $request->reject_reason;
            } else {
                $updateData['reject_reason'] = null;
            }

            $record->update($updateData);

            Log::info('Approval successful', [
                'record_id' => $record->id,
                'new_status' => $request->status,
                'approved_by' => Auth::user()->name
            ]);

            $statusText = $request->status === 'Approved' ? 'disetujui' : 'ditolak';
            return back()->with('success', "Data berhasil {$statusText}");
        } catch (\Exception $e) {
            Log::error("Approval Error: " . $e->getMessage(), [
                'table' => $table,
                'id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat memproses approval');
        }
    }
    /**
     * Bulk approval (opsional untuk approve multiple data sekaligus)
     */
    public function bulkApprove(Request $request, $table)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
            'status' => 'required|in:Approved,Rejected',
            'reject_reason' => 'required_if:status,Rejected|nullable|string|max:1000',
        ]);

        try {
            if (!isset($this->tableModelMap[$table])) {
                return back()->with('error', 'Tabel tidak valid');
            }

            $modelClass = $this->tableModelMap[$table];

            $updateData = [
                'status' => $request->status,
                'approved_by' => Auth::user()->name,
                'approved_at' => Carbon::now(),
            ];

            if ($request->status === 'Rejected') {
                $updateData['reject_reason'] = $request->reject_reason;
            }

            $affected = $modelClass::whereIn('id', $request->ids)
                ->where('status', 'Pending')
                ->update($updateData);

            $statusText = $request->status === 'Approved' ? 'disetujui' : 'ditolak';
            return back()->with('success', "{$affected} data berhasil {$statusText}");
        } catch (\Exception $e) {
            Log::error("Bulk Approval Error: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses bulk approval');
        }
    }

    /**
     * Get approval statistics
     */
    public function getApprovalStats($table)
    {
        if (!isset($this->tableModelMap[$table])) {
            return response()->json(['error' => 'Tabel tidak valid'], 400);
        }

        $modelClass = $this->tableModelMap[$table];

        $stats = $modelClass::selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = "Approved" THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN status = "Rejected" THEN 1 ELSE 0 END) as rejected
        ')->first();

        return response()->json($stats);
    }

    // /**
    //  * Log approval activity
    //  */
    // private function logApprovalActivity($table, $record, $status)
    // {
    //     if (class_exists(\Spatie\Activitylog\Models\Activity::class)) {
    //         activity()
    //             ->causedBy(auth()->user())
    //             ->performedOn($record)
    //             ->withProperties([
    //                 'table' => $table,
    //                 'status' => $status,
    //                 'approved_by' => auth()->user()->name,
    //             ])
    //             ->log("Data {$table} ID {$record->id} {$status}");
    //     }
    // }
}
