<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\PkkDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PkkDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PkkDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pkkDesas = PkkDesa::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.pkk-desa.index', compact('pkkDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $pkkDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pkkDesa = new PkkDesa();
        $desas = Desa::all();

        return view('superadmin.pkk-desa.create', compact('pkkDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PkkDesaRequest $request): RedirectResponse
    {
        PkkDesa::create($request->validated());

        return Redirect::route('superadmin.pkk-desa.index')
            ->with('success', 'PkkDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $pkkDesa = PkkDesa::find($id);

        return view('superadmin.pkk-desa.show', compact('pkkDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pkkDesa = PkkDesa::find($id);
        $desas = Desa::all();

        return view('superadmin.pkk-desa.edit', compact('pkkDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PkkDesaRequest $request, PkkDesa $pkkDesa): RedirectResponse
    {
        $pkkDesa->update($request->validated());

        return Redirect::route('superadmin.pkk-desa.index')
            ->with('success', 'PkkDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        PkkDesa::find($id)->delete();

        return Redirect::route('superadmin.pkk-desa.index')
            ->with('success', 'PkkDesa deleted successfully');
    }
}
