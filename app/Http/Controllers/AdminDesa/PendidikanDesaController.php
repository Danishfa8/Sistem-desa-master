<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\PendidikanDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PendidikanDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PendidikanDesaController extends Controller
{
    public function index(Request $request): View
    {
        $pendidikanDesas = PendidikanDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.pendidikan-desa.index', compact('pendidikanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $pendidikanDesas->perPage());
    }

    public function create(): View
    {
        $pendidikanDesa = new PendidikanDesa();
        $desas = Desa::all();

        return view('admin_desa.pendidikan-desa.create', compact('pendidikanDesa', 'desas'));
    }

    public function store(PendidikanDesaRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('foto_pendidikan', $fotoName, 'public');
            $validatedData['foto'] = $fotoName;
        }

        PendidikanDesa::create($validatedData);

        return Redirect::route('admin_desa.pendidikan-desa.index')
            ->with('success', 'Data Pendidikan Desa berhasil dibuat.');
    }

    public function show($id): View
    {
        $pendidikanDesa = PendidikanDesa::findOrFail($id);

        return view('admin_desa.pendidikan-desa.show', compact('pendidikanDesa'));
    }

    public function edit($id): View
    {
        $pendidikanDesa = PendidikanDesa::findOrFail($id);
        $desas = Desa::all();

        return view('admin_desa.pendidikan-desa.edit', compact('pendidikanDesa', 'desas'));
    }

    public function update(PendidikanDesaRequest $request, PendidikanDesa $pendidikanDesa): RedirectResponse
    {
        if (!in_array($pendidikanDesa->status, ['Arsip', 'Rejected'])) {
            return back()->with('error', 'Data yang sudah diajukan tidak dapat diedit.');
        }

        $validatedData = $request->validated();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pendidikanDesa->foto && Storage::disk('public')->exists('foto_pendidikan/' . $pendidikanDesa->foto)) {
                Storage::disk('public')->delete('foto_pendidikan/' . $pendidikanDesa->foto);
            }

            // Simpan foto baru
            $filename = time() . '_' . uniqid() . '.' . $request->foto->getClientOriginalExtension();
            $request->file('foto')->storeAs('foto_pendidikan', $filename, 'public');
            $validatedData['foto'] = $filename;
        }

        $pendidikanDesa->update($validatedData);

        return Redirect::route('admin_desa.pendidikan-desa.index')
            ->with('success', 'Data Pendidikan Desa berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $pendidikanDesa = PendidikanDesa::findOrFail($id);

        if (!in_array($pendidikanDesa->status, ['Arsip', 'Rejected'])) {
            return back()->with('error', 'Data yang sudah diajukan tidak dapat dihapus.');
        }

        if ($pendidikanDesa->foto && Storage::disk('public')->exists('foto_pendidikan/' . $pendidikanDesa->foto)) {
            Storage::disk('public')->delete('foto_pendidikan/' . $pendidikanDesa->foto);
        }

        $pendidikanDesa->delete();

        return Redirect::route('admin_desa.pendidikan-desa.index')
            ->with('success', 'Data Pendidikan Desa berhasil dihapus.');
    }

    public function ajukan($id): RedirectResponse
    {
        $pendidikan = PendidikanDesa::findOrFail($id);

        if (!in_array($pendidikan->status, ['Arsip', 'Rejected'])) {
            return back()->with('error', 'Hanya data dengan status Arsip atau Rejected yang dapat diajukan.');
        }

        $pendidikan->status = 'Pending';
        $pendidikan->save();

        return redirect()->route('admin_desa.pendidikan-desa.index')
            ->with('success', 'Data berhasil diajukan ke Admin Kabupaten.');
    }
}
