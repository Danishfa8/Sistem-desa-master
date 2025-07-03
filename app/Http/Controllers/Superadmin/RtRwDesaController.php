<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;

use App\Models\RtRwDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RtRwDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RtRwDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $rtRwDesas = RtRwDesa::with('desa')->paginate();

        return view('superadmin.rt-rw-desa.index', compact('rtRwDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $rtRwDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $rtRwDesa = new RtRwDesa();
        $desas = Desa::all();

        return view('superadmin.rt-rw-desa.create', compact('rtRwDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RtRwDesaRequest $request): RedirectResponse
    {
        RtRwDesa::create($request->validated());

        return Redirect::route('superadmin.rt-rw-desa.index')
            ->with('success', 'RtRwDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $rtRwDesa = RtRwDesa::find($id);

        return view('superadmin.rt-rw-desa.show', compact('rtRwDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $rtRwDesa = RtRwDesa::find($id);
        $desas = Desa::all();

        return view('superadmin.rt-rw-desa.edit', compact('rtRwDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RtRwDesaRequest $request, RtRwDesa $rtRwDesa): RedirectResponse
    {
        $rtRwDesa->update($request->validated());

        return Redirect::route('superadmin.rt-rw-desa.index')
            ->with('success', 'RtRwDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        RtRwDesa::find($id)->delete();

        return Redirect::route('superadmin.rt-rw-desa.index')
            ->with('success', 'RtRwDesa deleted successfully');
    }
}
