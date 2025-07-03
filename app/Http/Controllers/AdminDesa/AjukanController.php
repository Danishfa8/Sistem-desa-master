<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AjukanController extends Controller
{
    /**
     * Konfigurasi semua resource dalam satu tempat
     * Tinggal tambah resource baru di sini, tidak perlu ubah controller lain
     */
    private function getResourceConfig()
    {
        return [
            'kelembagaan-desa' => [
                'model' => 'App\Models\KelembagaanDesa',
                'status_field' => 'status',
                'name' => 'Kelembagaan Desa',
                'redirect' => 'admin_desa.kelembagaan-desa.index'
            ],
            'bumdes' => [
                'model' => 'App\Models\Bumde',
                'status_field' => 'status',
                'name' => 'Bumdes',
                'redirect' => 'admin_desa.bumdes.index'
            ],
            'lpmdk' => [
                'model' => 'App\Models\Lpmdk',
                'status_field' => 'status',
                'name' => 'Lpmdk',
                'redirect' => 'admin_desa.lpmdk.index'
            ],
            'pkk-desa' => [
                'model' => 'App\Models\PkkDesa',
                'status_field' => 'status',
                'name' => 'PkkDesa',
                'redirect' => 'admin_desa.pkk-desa.index'
            ],
            'jembatan-desa' => [
                'model' => 'App\Models\JembatanDesa',
                'status_field' => 'status',
                'name' => 'JembatanDesa',
                'redirect' => 'admin_desa.jembatan-desa.index'
            ],
            'jalan-desa' => [
                'model' => 'App\Models\JalanDesa',
                'status_field' => 'status',
                'name' => 'JalanDesa',
                'redirect' => 'admin_desa.jalan-desa.index'
            ],
            'jalan-kabupaten-desa' => [
                'model' => 'App\Models\JalanKabupatenDesa',
                'status_field' => 'status',
                'name' => 'JalanKabupatenDesa',
                'redirect' => 'admin_desa.jalan-kabupaten-desa.index'
            ],
            'kerawanan-sosial-desa' => [
                'model' => 'App\Models\KerawananSosialDesa',
                'status_field' => 'status',
                'name' => 'KerawananSosialDesa',
                'redirect' => 'admin_desa.kerawanan-sosial-desa.index'
            ],
            'kondisi-lingkungan-keluarga-desa' => [
                'model' => 'App\Models\KondisiLingkunganKeluargaDesa',
                'status_field' => 'status',
                'name' => 'KondisiLingkunganKeluargaDesa',
                'redirect' => 'admin_desa.kondisi-lingkungan-keluarga-desa.index'
            ],
            'tempat-tinggal-desa' => [
                'model' => 'App\Models\TempatTinggalDesa',
                'status_field' => 'status',
                'name' => 'TempatTinggalDesa',
                'redirect' => 'admin_desa.tempat-tinggal-desa.index'
            ],
            'disabilitas-desa' => [
                'model' => 'App\Models\DisabilitasDesa',
                'status_field' => 'status',
                'name' => 'DisabilitasDesa',
                'redirect' => 'admin_desa.disabilitas-desa.index'
            ],
            'balita-desa' => [
                'model' => 'App\Models\BalitaDesa',
                'status_field' => 'status',
                'name' => 'BalitaDesa',
                'redirect' => 'admin_desa.balita-desa.index'
            ],
            'lansia-desa' => [
                'model' => 'App\Models\LansiaDesa',
                'status_field' => 'status',
                'name' => 'LansiaDesa',
                'redirect' => 'admin_desa.lansia-desa.index'
            ],
            'pendidikan-desa' => [
                'model' => 'App\Models\PendidikanDesa',
                'status_field' => 'status',
                'name' => 'PendidikanDesa',
                'redirect' => 'admin_desa.pendidikan-desa.index'
            ],
            'olahraga-desa' => [
                'model' => 'App\Models\OlahragaDesa',
                'status_field' => 'status',
                'name' => 'OlahragaDesa',
                'redirect' => 'admin_desa.olahraga-desa.index'
            ],
            'pelaku-umkm-desa' => [
                'model' => 'App\Models\PelakuUmkmDesa',
                'status_field' => 'status',
                'name' => 'PelakuUmkmDesa',
                'redirect' => 'admin_desa.pelaku-umkm-desa.index'
            ],
            'sarana-kesehatan-desa' => [
                'model' => 'App\Models\SaranaKesehatanDesa',
                'status_field' => 'status',
                'name' => 'SaranaKesehatanDesa',
                'redirect' => 'admin_desa.sarana-kesehatan-desa.index'
            ],
            'sarana-pendukung-kesehatan-desa' => [
                'model' => 'App\Models\SaranaPendukungKesehatanDesa',
                'status_field' => 'status',
                'name' => 'SaranaPendukungKesehatanDesa',
                'redirect' => 'admin_desa.sarana-pendukung-kesehatan-desa.index'
            ],
            'sarana-ibadah-desa' => [
                'model' => 'App\Models\SaranaIbadahDesa',
                'status_field' => 'status',
                'name' => 'SaranaIbadahDesa',
                'redirect' => 'admin_desa.sarana-ibadah-desa.index'
            ],
            'sarana-lainya-desa' => [
                'model' => 'App\Models\SaranaLainyaDesa',
                'status_field' => 'status',
                'name' => 'SaranaLainyaDesa',
                'redirect' => 'admin_desa.sarana-lainya-desa.index'
            ],
            'industri-penghasil-limbah-desa' => [
                'model' => 'App\Models\IndustriPenghasilLimbahDesa',
                'status_field' => 'status',
                'name' => 'IndustriPenghasilLimbahDesa',
                'redirect' => 'admin_desa.industri-penghasil-limbah-desa.index'
            ],
            'energi-desa' => [
                'model' => 'App\Models\EnergiDesa',
                'status_field' => 'status',
                'name' => 'EnergiDesa',
                'redirect' => 'admin_desa.energi-desa.index'
            ],
            'sumber-daya-alam-desa' => [
                'model' => 'App\Models\SumberDayaAlamDesa',
                'status_field' => 'status',
                'name' => 'SumberDayaAlamDesa',
                'redirect' => 'admin_desa.sumber-daya-alam-desa.index'
            ],

        ];
    }

    public function ajukan(Request $request, $resource, $id)
    {
        try {
            $configs = $this->getResourceConfig();

            if (!isset($configs[$resource])) {
                return $this->redirectWithError('Resource tidak ditemukan!');
            }

            $config = $configs[$resource];
            $modelClass = $config['model'];
            $statusField = $config['status_field'];
            $resourceName = $config['name'];

            if (!class_exists($modelClass)) {
                return $this->redirectWithError("Model {$modelClass} tidak ditemukan!");
            }

            // Find record
            $record = $modelClass::findOrFail($id);

            // Validasi status
            $currentStatus = $record->{$statusField};
            if ($currentStatus !== 'Arsip') {
                return $this->redirectWithError("Hanya data dengan status 'Arsip' yang bisa diajukan! Status saat ini: {$currentStatus}");
            }

            // Update record
            $updateData = [
                $statusField => 'Pending',
            ];

            // Cek apakah kolom exists di tabel (optional safety check)
            $this->updateSafely($record, $updateData);

            // Success redirect
            $redirectRoute = $config['redirect'] ?? 'dashboard';
            return redirect()->route($redirectRoute)
                ->with('success', "{$resourceName} berhasil diajukan untuk approval!");
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->redirectWithError('Data tidak ditemukan!');
        } catch (\Exception $e) {
            Log::error("Error ajukan {$resource} ID {$id}: " . $e->getMessage());
            return $this->redirectWithError('Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    /**
     * Update record dengan safety check untuk kolom yang mungkin tidak ada
     */
    private function updateSafely($record, $updateData)
    {
        $safeUpdateData = [];
        $fillable = $record->getFillable();

        foreach ($updateData as $key => $value) {
            // Hanya update kolom yang ada di fillable atau yang bisa diupdate
            if (in_array($key, $fillable) || $record->isFillable($key)) {
                $safeUpdateData[$key] = $value;
            }
        }

        if (!empty($safeUpdateData)) {
            $record->update($safeUpdateData);
        }
    }

    private function redirectWithError($message)
    {
        return redirect()->back()->with('error', $message);
    }
}
