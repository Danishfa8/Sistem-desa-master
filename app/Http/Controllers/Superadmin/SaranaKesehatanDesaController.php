<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SaranaKesehatanDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SaranaKesehatanDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SaranaKesehatanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $saranaKesehatanDesas = SaranaKesehatanDesa::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.sarana-kesehatan-desa.index', compact('saranaKesehatanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $saranaKesehatanDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $saranaKesehatanDesa = new SaranaKesehatanDesa();
        $desas = Desa::all();

        return view('superadmin.sarana-kesehatan-desa.create', compact('saranaKesehatanDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaranaKesehatanDesaRequest $request): RedirectResponse
    {
        SaranaKesehatanDesa::create($request->validated());

        return Redirect::route('superadmin.sarana-kesehatan-desa.index')
            ->with('success', 'SaranaKesehatanDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $saranaKesehatanDesa = SaranaKesehatanDesa::find($id);

        return view('superadmin.sarana-kesehatan-desa.show', compact('saranaKesehatanDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $saranaKesehatanDesa = SaranaKesehatanDesa::find($id);

        return view('superadmin.sarana-kesehatan-desa.edit', compact('saranaKesehatanDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaranaKesehatanDesaRequest $request, SaranaKesehatanDesa $saranaKesehatanDesa): RedirectResponse
    {
        $saranaKesehatanDesa->update($request->validated());

        return Redirect::route('superadmin.sarana-kesehatan-desa.index')
            ->with('success', 'SaranaKesehatanDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        SaranaKesehatanDesa::find($id)->delete();

        return Redirect::route('superadmin.sarana-kesehatan-desa.index')
            ->with('success', 'SaranaKesehatanDesa deleted successfully');
    }
}
