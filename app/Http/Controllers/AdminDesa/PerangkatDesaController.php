<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PerangkatDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PerangkatDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perangkatDesas = PerangkatDesa::with('desa')->paginate();

        return view('admin_desa.perangkat-desa.index', compact('perangkatDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $perangkatDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $perangkatDesa = new PerangkatDesa();
        $desas = Desa::all();

        return view('admin_desa.perangkat-desa.create', compact('perangkatDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PerangkatDesaRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if (request()->hasFile('foto')) {
            $foto = request()->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('perangkat-desa', $fotoName, 'public');

            $validatedData['foto'] = 'perangkat-desa/' . $fotoName;
        }

        PerangkatDesa::create($validatedData);

        return Redirect::route('admin_desa.sarana-ibadah-desa.index')
            ->with('success', 'ProfileDesa berhasil dibuat dengan foto.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $perangkatDesa = PerangkatDesa::find($id);

        return view('admin_desa.perangkat-desa.show', compact('perangkatDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $perangkatDesa = PerangkatDesa::find($id);

        return view('admin_desa.perangkat-desa.edit', compact('perangkatDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PerangkatDesaRequest $request, PerangkatDesa $perangkatDesa): RedirectResponse
    {
        $perangkatDesa->update($request->validated());

        return Redirect::route('admin_desa.perangkat-desa.index')
            ->with('success', 'PerangkatDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        PerangkatDesa::find($id)->delete();

        return Redirect::route('admin_desa.perangkat-desa.index')
            ->with('success', 'PerangkatDesa deleted successfully');
    }
}
