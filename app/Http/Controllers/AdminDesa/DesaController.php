<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DesaRequest;
use App\Models\Kecamatan;
use App\Models\ProfileDesa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $desas = Desa::with('kecamatan', 'profileDesa')->paginate();
        // $profileDesa = ProfileDesa::all();

        return view('admin_desa.desa.index', compact('desas'))
            ->with('i', ($request->input('page', 1) - 1) * $desas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $desa = new Desa();
        $kecamatans = Kecamatan::all();

        return view('admin_desa.desa.create', compact('desa', 'kecamatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesaRequest $request): RedirectResponse
    {
        Desa::create($request->validated());

        return Redirect::route('admin_desa.desas.index')
            ->with('success', 'Desa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $desa = Desa::find($id);

        return view('admin_desa.desa.show', compact('desa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $desa = Desa::find($id);
        $kecamatans = Kecamatan::all();

        return view('admin_desa.desa.edit', compact('desa', 'kecamatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesaRequest $request, Desa $desa): RedirectResponse
    {
        $desa->update($request->validated());

        return Redirect::route('admin_desa.desas.index')
            ->with('success', 'Desa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Desa::find($id)->delete();

        return Redirect::route('admin_desa.desas.index')
            ->with('success', 'Desa deleted successfully');
    }
}
