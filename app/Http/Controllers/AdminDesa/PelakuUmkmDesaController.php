<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\PelakuUmkmDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PelakuUmkmDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PelakuUmkmDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pelakuUmkmDesas = PelakuUmkmDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.pelaku-umkm-desa.index', compact('pelakuUmkmDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $pelakuUmkmDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pelakuUmkmDesa = new PelakuUmkmDesa();
        $desas = Desa::all();

        return view('admin_desa.pelaku-umkm-desa.create', compact('pelakuUmkmDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PelakuUmkmDesaRequest $request): RedirectResponse
    {
        PelakuUmkmDesa::create($request->validated());

        return Redirect::route('admin_desa.pelaku-umkm-desa.index')
            ->with('success', 'PelakuUmkmDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $pelakuUmkmDesa = PelakuUmkmDesa::find($id);

        return view('admin_desa.pelaku-umkm-desa.show', compact('pelakuUmkmDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pelakuUmkmDesa = PelakuUmkmDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.pelaku-umkm-desa.edit', compact('pelakuUmkmDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PelakuUmkmDesaRequest $request, PelakuUmkmDesa $pelakuUmkmDesa): RedirectResponse
    {
        $pelakuUmkmDesa->update($request->validated());

        return Redirect::route('admin_desa.pelaku-umkm-desa.index')
            ->with('success', 'PelakuUmkmDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        PelakuUmkmDesa::find($id)->delete();

        return Redirect::route('admin_desa.pelaku-umkm-desa.index')
            ->with('success', 'PelakuUmkmDesa deleted successfully');
    }
}
