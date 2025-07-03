<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SaranaIbadahDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SaranaIbadahDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SaranaIbadahDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $saranaIbadahDesas = SaranaIbadahDesa::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.sarana-ibadah-desa.index', compact('saranaIbadahDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $saranaIbadahDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $saranaIbadahDesa = new SaranaIbadahDesa();
        $desas = Desa::all();

        return view('superadmin.sarana-ibadah-desa.create', compact('saranaIbadahDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaranaIbadahDesaRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if (request()->hasFile('foto')) {
            $foto = request()->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('sarana-ibadah-desa', $fotoName, 'public');

            $validatedData['foto'] = 'sarana-ibadah-desa/' . $fotoName;
        }

        SaranaIbadahDesa::create($validatedData);

        return Redirect::route('superadmin.sarana-ibadah-desa.index')
            ->with('success', 'ProfileDesa berhasil dibuat dengan foto.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $saranaIbadahDesa = SaranaIbadahDesa::find($id);

        return view('superadmin.sarana-ibadah-desa.show', compact('saranaIbadahDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $saranaIbadahDesa = SaranaIbadahDesa::find($id);
        $desas = Desa::all();

        return view('superadmin.sarana-ibadah-desa.edit', compact('saranaIbadahDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaranaIbadahDesaRequest $request, SaranaIbadahDesa $saranaIbadahDesa): RedirectResponse
    {
        $saranaIbadahDesa->update($request->validated());

        return Redirect::route('superadmin.sarana-ibadah-desa.index')
            ->with('success', 'SaranaIbadahDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        SaranaIbadahDesa::find($id)->delete();

        return Redirect::route('superadmin.sarana-ibadah-desa.index')
            ->with('success', 'SaranaIbadahDesa deleted successfully');
    }
}
