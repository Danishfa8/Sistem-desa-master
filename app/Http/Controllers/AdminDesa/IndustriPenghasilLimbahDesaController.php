<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\IndustriPenghasilLimbahDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\IndustriPenghasilLimbahDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class IndustriPenghasilLimbahDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $industriPenghasilLimbahDesas = IndustriPenghasilLimbahDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.industri-penghasil-limbah-desa.index', compact('industriPenghasilLimbahDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $industriPenghasilLimbahDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $industriPenghasilLimbahDesa = new IndustriPenghasilLimbahDesa();
        $desas = Desa::all();

        return view('admin_desa.industri-penghasil-limbah-desa.create', compact('industriPenghasilLimbahDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IndustriPenghasilLimbahDesaRequest $request): RedirectResponse
    {
        IndustriPenghasilLimbahDesa::create($request->validated());

        return Redirect::route('admin_desa.industri-penghasil-limbah-desa.index')
            ->with('success', 'IndustriPenghasilLimbahDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $industriPenghasilLimbahDesa = IndustriPenghasilLimbahDesa::find($id);

        return view('admin_desa.industri-penghasil-limbah-desa.show', compact('industriPenghasilLimbahDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $industriPenghasilLimbahDesa = IndustriPenghasilLimbahDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.industri-penghasil-limbah-desa.edit', compact('industriPenghasilLimbahDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IndustriPenghasilLimbahDesaRequest $request, IndustriPenghasilLimbahDesa $industriPenghasilLimbahDesa): RedirectResponse
    {
        $industriPenghasilLimbahDesa->update($request->validated());

        return Redirect::route('admin_desa.industri-penghasil-limbah-desa.index')
            ->with('success', 'IndustriPenghasilLimbahDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        IndustriPenghasilLimbahDesa::find($id)->delete();

        return Redirect::route('admin_desa.industri-penghasil-limbah-desa.index')
            ->with('success', 'IndustriPenghasilLimbahDesa deleted successfully');
    }
}
