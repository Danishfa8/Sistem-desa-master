<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\KerawananSosialDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\KerawananSosialDesaRequest;
use App\Models\Desa;
use App\Models\Kategori;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class KerawananSosialDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $kerawananSosialDesas = KerawananSosialDesa::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.kerawanan-sosial-desa.index', compact('kerawananSosialDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $kerawananSosialDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kategoris = Kategori::all();
        $kerawananSosialDesa = new KerawananSosialDesa();
        $desas = Desa::all();

        return view('superadmin.kerawanan-sosial-desa.create', compact('kategoris','kerawananSosialDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KerawananSosialDesaRequest $request): RedirectResponse
    {
        KerawananSosialDesa::create($request->validated());

        return Redirect::route('superadmin.kerawanan-sosial-desa.index')
            ->with('success', 'KerawananSosialDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $kerawananSosialDesa = KerawananSosialDesa::find($id);

        return view('superadmin.kerawanan-sosial-desa.show', compact('kerawananSosialDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $kategoris = Kategori::all();
        $kerawananSosialDesa = KerawananSosialDesa::find($id);
        $desas = Desa::all();

        return view('superadmin.kerawanan-sosial-desa.edit', compact('kategoris','kerawananSosialDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KerawananSosialDesaRequest $request, KerawananSosialDesa $kerawananSosialDesa): RedirectResponse
    {
        $kerawananSosialDesa->update($request->validated());

        return Redirect::route('superadmin.kerawanan-sosial-desa.index')
            ->with('success', 'KerawananSosialDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        KerawananSosialDesa::find($id)->delete();

        return Redirect::route('superadmin.kerawanan-sosial-desa.index')
            ->with('success', 'KerawananSosialDesa deleted successfully');
    }
}
