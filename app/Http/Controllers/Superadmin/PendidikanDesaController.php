<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\PendidikanDesa;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\PendidikanDesaRequest;

class PendidikanDesaController extends Controller
{
    public function index(Request $request): View
    {
        $pendidikanDesas = PendidikanDesa::with('desa', 'rtRwDesa')->latest()->paginate(10);

        return view('superadmin.pendidikan-desa.index', compact('pendidikanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $pendidikanDesas->perPage());
    }

    public function create(): View
    {
        $pendidikanDesa = new PendidikanDesa();
        $desas = Desa::all();

        return view('superadmin.pendidikan-desa.create', compact('pendidikanDesa', 'desas'));
    }

    public function store(PendidikanDesaRequest $request)
    {
        $data = $request->validated();

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $filename = time() . '_' . uniqid() . '.' . $request->foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_pendidikan', $request->file('foto'), $filename);
            $data['foto'] = $filename;
        }

        // Auto-approve dan info pembuat
        $data['created_by'] = Auth::user()->name;
        $data['updated_by'] = Auth::user()->name;
        $data['status'] = 'Approved';
        $data['approved_by'] = Auth::user()->name;
        $data['approved_at'] = now();

        PendidikanDesa::create($data);

        return Redirect::route('superadmin.pendidikan-desa.index')
            ->with('success', 'Data Pendidikan Desa berhasil ditambahkan dan disetujui.');
    }

    public function show($id): View
    {
        $pendidikanDesa = PendidikanDesa::with('desa', 'rtRwDesa')->findOrFail($id);
        return view('superadmin.pendidikan-desa.show', compact('pendidikanDesa'));
    }

    public function edit($id): View
    {
        $pendidikanDesa = PendidikanDesa::findOrFail($id);
        $desas = Desa::all();

        return view('superadmin.pendidikan-desa.edit', compact('pendidikanDesa', 'desas'));
    }

    public function update(PendidikanDesaRequest $request, $id)
    {
        $pendidikanDesa = PendidikanDesa::findOrFail($id);
        $data = $request->validated();

        // Ganti foto jika ada upload baru
        if ($request->hasFile('foto')) {
            if ($pendidikanDesa->foto && Storage::disk('public')->exists('foto_pendidikan/' . $pendidikanDesa->foto)) {
                Storage::disk('public')->delete('foto_pendidikan/' . $pendidikanDesa->foto);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_pendidikan', $request->file('foto'), $filename);
            $data['foto'] = $filename;
        }

        $data['updated_by'] = Auth::user()->name;
        $data['status'] = 'Approved';
        $data['approved_by'] = Auth::user()->name;
        $data['approved_at'] = now();

        $pendidikanDesa->update($data);

        return Redirect::route('superadmin.pendidikan-desa.index')
            ->with('success', 'Data Pendidikan Desa berhasil diperbarui dan disetujui.');
    }

    public function destroy($id)
    {
        $pendidikanDesa = PendidikanDesa::findOrFail($id);

        if ($pendidikanDesa->foto && Storage::disk('public')->exists('foto_pendidikan/' . $pendidikanDesa->foto)) {
            Storage::disk('public')->delete('foto_pendidikan/' . $pendidikanDesa->foto);
        }

        $pendidikanDesa->delete();

        return Redirect::route('superadmin.pendidikan-desa.index')
            ->with('success', 'Data Pendidikan Desa berhasil dihapus.');
    }
}
