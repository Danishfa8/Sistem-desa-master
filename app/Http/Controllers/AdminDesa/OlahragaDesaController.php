<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\OlahragaDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\OlahragaDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OlahragaDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $olahragaDesas = OlahragaDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.olahraga-desa.index', compact('olahragaDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $olahragaDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $olahragaDesa = new OlahragaDesa();
        $desas = Desa::all();

        return view('admin_desa.olahraga-desa.create', compact('olahragaDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OlahragaDesaRequest $request): RedirectResponse
    {
        OlahragaDesa::create($request->validated());

        return Redirect::route('admin_desa.olahraga-desa.index')
            ->with('success', 'OlahragaDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $olahragaDesa = OlahragaDesa::find($id);

        return view('admin_desa.olahraga-desa.show', compact('olahragaDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $olahragaDesa = OlahragaDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.olahraga-desa.edit', compact('olahragaDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OlahragaDesaRequest $request, OlahragaDesa $olahragaDesa): RedirectResponse
    {
        $olahragaDesa->update($request->validated());

        return Redirect::route('admin_desa.olahraga-desa.index')
            ->with('success', 'OlahragaDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        OlahragaDesa::find($id)->delete();

        return Redirect::route('admin_desa.olahraga-desa.index')
            ->with('success', 'OlahragaDesa deleted successfully');
    }
}
