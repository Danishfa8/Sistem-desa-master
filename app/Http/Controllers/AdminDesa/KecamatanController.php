<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\KecamatanRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $kecamatans = Kecamatan::paginate();

        return view('admin_desa.kecamatan.index', compact('kecamatans'))
            ->with('i', ($request->input('page', 1) - 1) * $kecamatans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kecamatan = new Kecamatan();

        return view('admin_desa.kecamatan.create', compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KecamatanRequest $request): RedirectResponse
    {
        Kecamatan::create($request->validated());

        return Redirect::route('admin_desa.kecamatans.index')
            ->with('success', 'Kecamatan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $kecamatan = Kecamatan::find($id);

        return view('admin_desa.kecamatan.show', compact('admin_desa.'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $kecamatan = Kecamatan::find($id);

        return view('admin_desa.kecamatan.edit', compact('kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KecamatanRequest $request, Kecamatan $kecamatan): RedirectResponse
    {
        $kecamatan->update($request->validated());

        return Redirect::route('admin_desa.kecamatans.index')
            ->with('success', 'Kecamatan updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Kecamatan::find($id)->delete();

        return Redirect::route('admin_desa.kecamatans.index')
            ->with('success', 'Kecamatan deleted successfully');
    }
}
