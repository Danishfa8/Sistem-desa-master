<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\TempatTinggalDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TempatTinggalDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TempatTinggalDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tempatTinggalDesas = TempatTinggalDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.tempat-tinggal-desa.index', compact('tempatTinggalDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $tempatTinggalDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tempatTinggalDesa = new TempatTinggalDesa();
        $desas = Desa::all();

        return view('admin_desa.tempat-tinggal-desa.create', compact('tempatTinggalDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TempatTinggalDesaRequest $request): RedirectResponse
    {
        TempatTinggalDesa::create($request->validated());

        return Redirect::route('admin_desa.tempat-tinggal-desa.index')
            ->with('success', 'TempatTinggalDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tempatTinggalDesa = TempatTinggalDesa::find($id);

        return view('admin_desa.tempat-tinggal-desa.show', compact('tempatTinggalDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tempatTinggalDesa = TempatTinggalDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.tempat-tinggal-desa.edit', compact('tempatTinggalDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TempatTinggalDesaRequest $request, TempatTinggalDesa $tempatTinggalDesa): RedirectResponse
    {
        $tempatTinggalDesa->update($request->validated());

        return Redirect::route('admin_desa.tempat-tinggal-desas.index')
            ->with('success', 'TempatTinggalDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        TempatTinggalDesa::find($id)->delete();

        return Redirect::route('admin_desa.tempat-tinggal-desas.index')
            ->with('success', 'TempatTinggalDesa deleted successfully');
    }
}
