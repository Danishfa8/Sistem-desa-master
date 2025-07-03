<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PengeluaranRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pengeluarans = Pengeluaran::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.pengeluaran.index', compact('pengeluarans'))
            ->with('i', ($request->input('page', 1) - 1) * $pengeluarans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pengeluaran = new Pengeluaran();
        $desas = Desa::all();

        return view('admin_desa.pengeluaran.create', compact('pengeluaran', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PengeluaranRequest $request): RedirectResponse
    {
        Pengeluaran::create($request->validated());

        return Redirect::route('admin_desa.pengeluaran.index')
            ->with('success', 'Pengeluaran created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $pengeluaran = Pengeluaran::find($id);

        return view('admin_desa.pengeluaran.show', compact('pengeluaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pengeluaran = Pengeluaran::find($id);
        $desas = Desa::all();

        return view('admin_desa.pengeluaran.edit', compact('pengeluaran', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PengeluaranRequest $request, Pengeluaran $pengeluaran): RedirectResponse
    {
        $pengeluaran->update($request->validated());

        return Redirect::route('admin_desa.pengeluaran.index')
            ->with('success', 'Pengeluaran updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Pengeluaran::find($id)->delete();

        return Redirect::route('admin_desa.pengeluaran.index')
            ->with('success', 'Pengeluaran deleted successfully');
    }
}
