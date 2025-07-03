<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\LansiaDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LansiaDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LansiaDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $lansiaDesas = LansiaDesa::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.lansia-desa.index', compact('lansiaDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $lansiaDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $lansiaDesa = new LansiaDesa();
        $desas = Desa::all();

        return view('superadmin.lansia-desa.create', compact('lansiaDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LansiaDesaRequest $request): RedirectResponse
    {
        LansiaDesa::create($request->validated());

        return Redirect::route('superadmin.lansia-desa.index')
            ->with('success', 'LansiaDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $lansiaDesa = LansiaDesa::find($id);

        return view('superadmin.lansia-desa.show', compact('lansiaDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $lansiaDesa = LansiaDesa::find($id);
        $desas = Desa::all();

        return view('superadmin.lansia-desa.edit', compact('lansiaDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LansiaDesaRequest $request, LansiaDesa $lansiaDesa): RedirectResponse
    {
        $lansiaDesa->update($request->validated());

        return Redirect::route('superadmin.lansia-desa.index')
            ->with('success', 'LansiaDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        LansiaDesa::find($id)->delete();

        return Redirect::route('superadmin.lansia-desa.index')
            ->with('success', 'LansiaDesa deleted successfully');
    }
}
