<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaranaIbadahDesaRequest;
use App\Models\Desa;
use App\Models\SaranaIbadahDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SaranaIbadahDesaController extends Controller
{
    public function index(Request $request): View
    {
        $saranaIbadahDesas = SaranaIbadahDesa::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.sarana-ibadah-desa.index', compact('saranaIbadahDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $saranaIbadahDesas->perPage());
    }

    public function create(): View
    {
        $saranaIbadahDesa = new SaranaIbadahDesa();
        $desas = Desa::all();

        return view('superadmin.sarana-ibadah-desa.create', compact('saranaIbadahDesa', 'desas'));
    }

    public function store(SaranaIbadahDesaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('sarana-ibadah-desa', $fotoName, 'public');
            $data['foto'] = 'sarana-ibadah-desa/' . $fotoName;
        }

        // Auto-approval + audit
        $data['created_by'] = Auth::user()->name;
        $data['updated_by'] = Auth::user()->name;
        $data['status'] = 'Approved';
        $data['approved_by'] = Auth::user()->name;
        $data['approved_at'] = now();

        SaranaIbadahDesa::create($data);

        return Redirect::route('superadmin.sarana-ibadah-desa.index')
            ->with('success', 'Data Sarana Ibadah Desa berhasil ditambahkan dan disetujui.');
    }

    public function show($id): View
    {
        $saranaIbadahDesa = SaranaIbadahDesa::with('desa', 'rtRwDesa')->findOrFail($id);

        return view('superadmin.sarana-ibadah-desa.show', compact('saranaIbadahDesa'));
    }

    public function edit($id): View
    {
        $saranaIbadahDesa = SaranaIbadahDesa::findOrFail($id);
        $desas = Desa::all();

        return view('superadmin.sarana-ibadah-desa.edit', compact('saranaIbadahDesa', 'desas'));
    }

    public function update(SaranaIbadahDesaRequest $request, SaranaIbadahDesa $saranaIbadahDesa): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($saranaIbadahDesa->foto && Storage::disk('public')->exists($saranaIbadahDesa->foto)) {
                Storage::disk('public')->delete($saranaIbadahDesa->foto);
            }

            $foto = $request->file('foto');
            $fotoName = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('sarana-ibadah-desa', $fotoName, 'public');
            $data['foto'] = 'sarana-ibadah-desa/' . $fotoName;
        }

        // Update audit
        $data['updated_by'] = Auth::user()->name;
        $data['status'] = 'Approved';
        $data['approved_by'] = Auth::user()->name;
        $data['approved_at'] = now();

        $saranaIbadahDesa->update($data);

        return Redirect::route('superadmin.sarana-ibadah-desa.index')
            ->with('success', 'Data Sarana Ibadah Desa berhasil diperbarui dan disetujui.');
    }

    public function destroy($id): RedirectResponse
    {
        $saranaIbadahDesa = SaranaIbadahDesa::findOrFail($id);

        if ($saranaIbadahDesa->foto && Storage::disk('public')->exists($saranaIbadahDesa->foto)) {
            Storage::disk('public')->delete($saranaIbadahDesa->foto);
        }

        $saranaIbadahDesa->delete();

        return Redirect::route('superadmin.sarana-ibadah-desa.index')
            ->with('success', 'Data Sarana Ibadah Desa berhasil dihapus.');
    }
}
