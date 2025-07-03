<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\JembatanDesa;
use App\Models\Desa;
use App\Http\Requests\JembatanDesaRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JembatanDesaController extends Controller
{
    public function index(Request $request): View
    {
        $jembatanDesas = JembatanDesa::with('desa', 'rtRwDesa')->paginate();
        return view('admin_desa.jembatan-desa.index', compact('jembatanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $jembatanDesas->perPage());
    }

    public function create(): View
    {
        $jembatanDesa = new JembatanDesa();
        $desas = Desa::all();
        return view('admin_desa.jembatan-desa.create', compact('jembatanDesa', 'desas'));
    }

    public function store(JembatanDesaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $filename = time() . '_' . uniqid() . '.' . $request->foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_jembatan', $request->file('foto'), $filename);
            $data['foto'] = $filename;
        }


        JembatanDesa::create($data);

        return Redirect::route('admin_desa.jembatan-desa.index')
            ->with('success', 'Data Jembatan Desa berhasil disimpan.');
    }

    public function show($id): View
    {
        $jembatanDesa = JembatanDesa::with('desa', 'rtRwDesa')->findOrFail($id);
        return view('admin_desa.jembatan-desa.show', compact('jembatanDesa'));
    }

    public function edit($id): View
    {
        $jembatanDesa = JembatanDesa::findOrFail($id);
        $desas = Desa::all();
        return view('admin_desa.jembatan-desa.edit', compact('jembatanDesa', 'desas'));
    }

    public function update(JembatanDesaRequest $request, JembatanDesa $jembatanDesa): RedirectResponse
    {
        if (!in_array($jembatanDesa->status, ['Arsip', 'Rejected'])) {
            return back()->with('error', 'Data yang sudah diajukan tidak dapat diedit.');
        }

        $data = $request->validated();

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($jembatanDesa->foto && Storage::disk('public')->exists('foto_jembatan/' . $jembatanDesa->foto)) {
                Storage::disk('public')->delete('foto_jembatan/' . $jembatanDesa->foto);
            }

            // Simpan foto baru
            $filename = time() . '_' . uniqid() . '.' . $request->foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_jembatan', $request->file('foto'), $filename);
            $data['foto'] = $filename;
        }




        $jembatanDesa->update($data);

        return Redirect::route('admin_desa.jembatan-desa.index')
            ->with('success', 'Data Jembatan Desa berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $jembatanDesa = JembatanDesa::findOrFail($id);

        if (!in_array($jembatanDesa->status, ['Arsip', 'Rejected'])) {
            return back()->with('error', 'Data yang sudah diajukan tidak dapat dihapus.');
        }

        if ($jembatanDesa->foto && Storage::exists('public/foto_jembatan/' . $jembatanDesa->foto)) {
            Storage::delete('public/foto_jembatan/' . $jembatanDesa->foto);
        }

        $jembatanDesa->delete();

        return Redirect::route('admin_desa.jembatan-desa.index')
            ->with('success', 'Data Jembatan Desa berhasil dihapus.');
    }

    public function ajukan($id): RedirectResponse
    {
        $jembatan = JembatanDesa::findOrFail($id);

        if (!in_array($jembatan->status, ['Arsip', 'Rejected'])) {
            return back()->with('error', 'Hanya data dengan status Arsip atau Rejected yang dapat diajukan.');
        }

        $jembatan->status = 'Pending';
        $jembatan->save();

        return redirect()->route('admin_desa.jembatan-desa.index')
            ->with('success', 'Data berhasil diajukan ke Admin Kabupaten.');
    }
}
