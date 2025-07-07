<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\JembatanDesa;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\JembatanDesaRequest;

class JembatanDesaController extends Controller
{
    public function index(Request $request): View
    {
        $jembatanDesas = JembatanDesa::with('desa', 'rtRwDesa')->latest()->paginate(10);

        return view('superadmin.jembatan-desa.index', compact('jembatanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $jembatanDesas->perPage());
    }

    public function create(): View
    {
        $jembatanDesa = new JembatanDesa();
        $desas = Desa::all();

        return view('superadmin.jembatan-desa.create', compact('jembatanDesa', 'desas'));
    }

    public function store(JembatanDesaRequest $request)
    {
        $data = $request->validated();

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $filename = time() . '_' . uniqid() . '.' . $request->foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_jembatan', $request->file('foto'), $filename);
            $data['foto'] = $filename; // hanya simpan nama file
        }

        // Auto-approve dan info pembuat
        $data['created_by'] = Auth::user()->name;
        $data['updated_by'] = Auth::user()->name;
        $data['status'] = 'Approved';
        $data['approved_by'] = Auth::user()->name;
        $data['approved_at'] = now();

        JembatanDesa::create($data);

        return Redirect::route('superadmin.jembatan-desa.index')
            ->with('success', 'Data Jembatan Desa berhasil ditambahkan dan disetujui.');
    }

    public function show($id): View
    {
        $jembatanDesa = JembatanDesa::with('desa', 'rtRwDesa')->findOrFail($id);
        return view('superadmin.jembatan-desa.show', compact('jembatanDesa'));
    }

    public function edit($id): View
    {
        $jembatanDesa = JembatanDesa::findOrFail($id);
        $desas = Desa::all();

        return view('superadmin.jembatan-desa.edit', compact('jembatanDesa', 'desas'));
    }

    public function update(JembatanDesaRequest $request, $id)
    {
        $jembatanDesa = JembatanDesa::findOrFail($id);
        $data = $request->validated();

        // Ganti foto jika ada upload baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($jembatanDesa->foto && Storage::disk('public')->exists('foto_jembatan/' . $jembatanDesa->foto)) {
                Storage::disk('public')->delete('foto_jembatan/' . $jembatanDesa->foto);
            }

            // Simpan foto baru
            $filename = time() . '_' . uniqid() . '.' . $request->foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_jembatan', $request->file('foto'), $filename);
            $data['foto'] = $filename; // hanya simpan nama file
        }

        $data['updated_by'] = Auth::user()->name;
        $data['status'] = 'Approved';
        $data['approved_by'] = Auth::user()->name;
        $data['approved_at'] = now();

        $jembatanDesa->update($data);

        return Redirect::route('superadmin.jembatan-desa.index')
            ->with('success', 'Data Jembatan Desa berhasil diperbarui dan disetujui.');
    }

    public function destroy($id)
    {
        $jembatanDesa = JembatanDesa::findOrFail($id);


        if ($jembatanDesa->foto && Storage::exists('public/foto_jembatan/' . $jembatanDesa->foto)) {
            Storage::delete('public/foto_jembatan/' . $jembatanDesa->foto);
        }

        $jembatanDesa->delete();

        return Redirect::route('superadmin.jembatan-desa.index')
            ->with('success', 'Data Jembatan Desa berhasil dihapus.');
    }
}
