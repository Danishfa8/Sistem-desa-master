<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\PendapatanDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PendapatanDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PendapatanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pendapatanDesas = PendapatanDesa::with('desa')->paginate();

        return view('admin_desa.pendapatan-desas.index', compact('pendapatanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $pendapatanDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pendapatanDesa = new PendapatanDesa();
        $desas = Desa::all();

        return view('admin_desa.pendapatan-desas.create', compact('pendapatanDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendapatanDesaRequest $request): RedirectResponse
    {
        PendapatanDesa::create($request->validated());
        // dd(session()->all());

        return Redirect::route('admin_desa.pendapatan-desas.index')
            ->with('success', 'PendapatanDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $pendapatanDesa = PendapatanDesa::find($id);

        return view('admin_desa.pendapatan-desas.show', compact('pendapatanDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pendapatanDesa = PendapatanDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.pendapatan-desas.edit', compact('pendapatanDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendapatanDesaRequest $request, PendapatanDesa $pendapatanDesa): RedirectResponse
    {
        $pendapatanDesa->update($request->validated());

        return Redirect::route('admin_desa.pendapatan-desas.index')
            ->with('success', 'PendapatanDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        PendapatanDesa::find($id)->delete();

        return Redirect::route('admin_desa.pendapatan-desas.index')
            ->with('success', 'PendapatanDesa deleted successfully');
    }
}
