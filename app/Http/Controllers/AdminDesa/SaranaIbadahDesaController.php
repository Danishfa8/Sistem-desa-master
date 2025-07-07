<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\SaranaIbadahDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SaranaIbadahDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SaranaIbadahDesaController extends Controller
{
    public function index(Request $request): View
    {
        $saranaIbadahDesas = SaranaIbadahDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.sarana-ibadah-desa.index', compact('saranaIbadahDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $saranaIbadahDesas->perPage());
    }

    public function create(): View
    {
        $saranaIbadahDesa = new SaranaIbadahDesa();
        $desas = Desa::all();

        return view('admin_desa.sarana-ibadah-desa.create', compact('saranaIbadahDesa', 'desas'));
    }

    public function store(SaranaIbadahDesaRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = 'sarana-ibadah-desa/' . $fotoName;
            $foto->storeAs('sarana-ibadah-desa', $fotoName, 'public');
            $validatedData['foto'] = $fotoPath;
        }

        SaranaIbadahDesa::create($validatedData);

        return Redirect::route('admin_desa.sarana-ibadah-desa.index')
            ->with('success', 'Data Sarana Ibadah Desa berhasil dibuat.');
    }

    public function show($id): View
    {
        $saranaIbadahDesa = SaranaIbadahDesa::findOrFail($id);
        return view('admin_desa.sarana-ibadah-desa.show', compact('saranaIbadahDesa'));
    }

    public function edit($id): View
    {
        $saranaIbadahDesa = SaranaIbadahDesa::findOrFail($id);
        $desas = Desa::all();

        return view('admin_desa.sarana-ibadah-desa.edit', compact('saranaIbadahDesa', 'desas'));
    }

    public function update(SaranaIbadahDesaRequest $request, SaranaIbadahDesa $saranaIbadahDesa): RedirectResponse
    {
        if (!in_array($saranaIbadahDesa->status, ['Arsip', 'Rejected'])) {
            return back()->with('error', 'Data yang sudah diajukan tidak dapat diedit.');
        }

        $validatedData = $request->validated();

        if ($request->hasFile('foto')) {
            if ($saranaIbadahDesa->foto && Storage::disk('public')->exists($saranaIbadahDesa->foto)) {
                Storage::disk('public')->delete($saranaIbadahDesa->foto);
            }

            $foto = $request->file('foto');
            $fotoName = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = 'sarana-ibadah-desa/' . $fotoName;
            $foto->storeAs('sarana-ibadah-desa', $fotoName, 'public');
            $validatedData['foto'] = $fotoPath;
        }

        $saranaIbadahDesa->update($validatedData);

        return Redirect::route('admin_desa.sarana-ibadah-desa.index')
            ->with('success', 'Data Sarana Ibadah Desa berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $saranaIbadahDesa = SaranaIbadahDesa::findOrFail($id);

        if (!in_array($saranaIbadahDesa->status, ['Arsip', 'Rejected'])) {
            return back()->with('error', 'Data yang sudah diajukan tidak dapat dihapus.');
        }

        if ($saranaIbadahDesa->foto && Storage::disk('public')->exists($saranaIbadahDesa->foto)) {
            Storage::disk('public')->delete($saranaIbadahDesa->foto);
        }

        $saranaIbadahDesa->delete();

        return Redirect::route('admin_desa.sarana-ibadah-desa.index')
            ->with('success', 'Data Sarana Ibadah Desa berhasil dihapus.');
    }

    public function ajukan($id): RedirectResponse
    {
        $saranaIbadahDesa = SaranaIbadahDesa::findOrFail($id);

        if (!in_array($saranaIbadahDesa->status, ['Arsip', 'Rejected'])) {
            return back()->with('error', 'Hanya data dengan status Arsip atau Rejected yang dapat diajukan.');
        }

        $saranaIbadahDesa->status = 'Pending';
        $saranaIbadahDesa->save();

        return Redirect::route('admin_desa.sarana-ibadah-desa.index')
            ->with('success', 'Data berhasil diajukan ke Admin Kabupaten.');
    }
}
