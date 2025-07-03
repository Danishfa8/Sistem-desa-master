<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SaranaPendukungKesehatanDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SaranaPendukungKesehatanDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SaranaPendukungKesehatanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $saranaPendukungKesehatanDesas = SaranaPendukungKesehatanDesa::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.sarana-pendukung-kesehatan-desa.index', compact('saranaPendukungKesehatanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $saranaPendukungKesehatanDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $saranaPendukungKesehatanDesa = new SaranaPendukungKesehatanDesa();
        $desas = Desa::all();

        return view('superadmin.sarana-pendukung-kesehatan-desa.create', compact('saranaPendukungKesehatanDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaranaPendukungKesehatanDesaRequest $request): RedirectResponse
    {
        SaranaPendukungKesehatanDesa::create($request->validated());

        return Redirect::route('superadmin.sarana-pendukung-kesehatan-desa.index')
            ->with('success', 'SaranaPendukungKesehatanDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $saranaPendukungKesehatanDesa = SaranaPendukungKesehatanDesa::find($id);

        return view('superadmin.sarana-pendukung-kesehatan-desa.show', compact('saranaPendukungKesehatanDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $saranaPendukungKesehatanDesa = SaranaPendukungKesehatanDesa::find($id);
        $desas = Desa::all();

        return view('superadmin.sarana-pendukung-kesehatan-desa.edit', compact('saranaPendukungKesehatanDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaranaPendukungKesehatanDesaRequest $request, SaranaPendukungKesehatanDesa $saranaPendukungKesehatanDesa): RedirectResponse
    {
        $saranaPendukungKesehatanDesa->update($request->validated());

        return Redirect::route('superadmin.sarana-pendukung-kesehatan-desa.index')
            ->with('success', 'SaranaPendukungKesehatanDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        SaranaPendukungKesehatanDesa::find($id)->delete();

        return Redirect::route('superadmin.sarana-pendukung-kesehatan-desa.index')
            ->with('success', 'SaranaPendukungKesehatanDesa deleted successfully');
    }
}
