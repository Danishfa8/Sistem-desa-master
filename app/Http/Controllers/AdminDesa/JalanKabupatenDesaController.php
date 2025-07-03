<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\JalanKabupatenDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\JalanKabupatenDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class JalanKabupatenDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $jalanKabupatenDesas = JalanKabupatenDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.jalan-kabupaten-desa.index', compact('jalanKabupatenDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $jalanKabupatenDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jalanKabupatenDesa = new JalanKabupatenDesa();
        $desas = Desa::all();

        return view('admin_desa.jalan-kabupaten-desa.create', compact('jalanKabupatenDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JalanKabupatenDesaRequest $request): RedirectResponse
    {
        JalanKabupatenDesa::create($request->validated());

        return Redirect::route('admin_desa.jalan-kabupaten-desa.index')
            ->with('success', 'JalanKabupatenDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $jalanKabupatenDesa = JalanKabupatenDesa::find($id);

        return view('admin_desa.jalan-kabupaten-desa.show', compact('jalanKabupatenDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $jalanKabupatenDesa = JalanKabupatenDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.jalan-kabupaten-desa.edit', compact('jalanKabupatenDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JalanKabupatenDesaRequest $request, JalanKabupatenDesa $jalanKabupatenDesa): RedirectResponse
    {
        $jalanKabupatenDesa->update($request->validated());

        return Redirect::route('admin_desa.jalan-kabupaten-desa.index')
            ->with('success', 'JalanKabupatenDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        JalanKabupatenDesa::find($id)->delete();

        return Redirect::route('admin_desa.jalan-kabupaten-desa.index')
            ->with('success', 'JalanKabupatenDesa deleted successfully');
    }
}
