<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\KondisiLingkunganKeluargaDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\KondisiLingkunganKeluargaDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class KondisiLingkunganKeluargaDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $kondisiLingkunganKeluargaDesas = KondisiLingkunganKeluargaDesa::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.kondisi-lingkungan-keluarga-desa.index', compact('kondisiLingkunganKeluargaDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $kondisiLingkunganKeluargaDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kondisiLingkunganKeluargaDesa = new KondisiLingkunganKeluargaDesa();
        $desas = Desa::all();

        return view('superadmin.kondisi-lingkungan-keluarga-desa.create', compact('kondisiLingkunganKeluargaDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KondisiLingkunganKeluargaDesaRequest $request): RedirectResponse
    {
        KondisiLingkunganKeluargaDesa::create($request->validated());

        return Redirect::route('superadmin.kondisi-lingkungan-keluarga-desa.index')
            ->with('success', 'KondisiLingkunganKeluargaDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $kondisiLingkunganKeluargaDesa = KondisiLingkunganKeluargaDesa::find($id);

        return view('superadmin.kondisi-lingkungan-keluarga-desa.show', compact('kondisiLingkunganKeluargaDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $kondisiLingkunganKeluargaDesa = KondisiLingkunganKeluargaDesa::find($id);
        $desas = Desa::all();

        return view('superadmin.kondisi-lingkungan-keluarga-desa.edit', compact('kondisiLingkunganKeluargaDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KondisiLingkunganKeluargaDesaRequest $request, KondisiLingkunganKeluargaDesa $kondisiLingkunganKeluargaDesa): RedirectResponse
    {
        $kondisiLingkunganKeluargaDesa->update($request->validated());

        return Redirect::route('superadmin.kondisi-lingkungan-keluarga-desa.index')
            ->with('success', 'KondisiLingkunganKeluargaDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        KondisiLingkunganKeluargaDesa::find($id)->delete();

        return Redirect::route('superadmin.kondisi-lingkungan-keluarga-desa.index')
            ->with('success', 'KondisiLingkunganKeluargaDesa deleted successfully');
    }
}
