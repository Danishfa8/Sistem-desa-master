<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\DisabilitasDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DisabilitasDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DisabilitasDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $disabilitasDesas = DisabilitasDesa::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.disabilitas-desa.index', compact('disabilitasDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $disabilitasDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $disabilitasDesa = new DisabilitasDesa();
        $desas = Desa::all();

        return view('superadmin.disabilitas-desa.create', compact('disabilitasDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DisabilitasDesaRequest $request): RedirectResponse
    {
        DisabilitasDesa::create($request->validated());

        return Redirect::route('superadmin.disabilitas-desa.index')
            ->with('success', 'DisabilitasDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $disabilitasDesa = DisabilitasDesa::find($id);

        return view('superadmin.disabilitas-desa.show', compact('disabilitasDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $disabilitasDesa = DisabilitasDesa::find($id);
        $desas = Desa::all();

        return view('superadmin.disabilitas-desa.edit', compact('disabilitasDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DisabilitasDesaRequest $request, DisabilitasDesa $disabilitasDesa): RedirectResponse
    {
        $disabilitasDesa->update($request->validated());

        return Redirect::route('superadmin.disabilitas-desa.index')
            ->with('success', 'DisabilitasDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        DisabilitasDesa::find($id)->delete();

        return Redirect::route('superadmin.disabilitas-desa.index')
            ->with('success', 'DisabilitasDesa deleted successfully');
    }
}
