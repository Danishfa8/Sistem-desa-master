<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\BalitaDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BalitaDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BalitaDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $balitaDesas = BalitaDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.balita-desa.index', compact('balitaDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $balitaDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $balitaDesa = new BalitaDesa();
        $desas = Desa::all();

        return view('admin_desa.balita-desa.create', compact('balitaDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BalitaDesaRequest $request): RedirectResponse
    {
        BalitaDesa::create($request->validated());

        return Redirect::route('admin_desa.balita-desa.index')
            ->with('success', 'BalitaDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $balitaDesa = BalitaDesa::find($id);

        return view('admin_desa.balita-desa.show', compact('balitaDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $balitaDesa = BalitaDesa::find($id);
        $desa = Desa::all();

        return view('admin_desa.balita-desa.edit', compact('balitaDesa', 'desa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BalitaDesaRequest $request, BalitaDesa $balitaDesa): RedirectResponse
    {
        $balitaDesa->update($request->validated());

        return Redirect::route('admin_desa.balita-desa.index')
            ->with('success', 'BalitaDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        BalitaDesa::find($id)->delete();

        return Redirect::route('admin_desa.balita-desa.index')
            ->with('success', 'BalitaDesa deleted successfully');
    }
}
