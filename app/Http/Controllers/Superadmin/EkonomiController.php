<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Ekonomi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EkonomiRequest;
use App\Models\Desa;
use App\Models\Kategori;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EkonomiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $ekonomis = Ekonomi::with('desa')->paginate();

        return view('superadmin.ekonomi.index', compact('ekonomis'))
            ->with('i', ($request->input('page', 1) - 1) * $ekonomis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kategoris = Kategori::all();
        $ekonomi = new Ekonomi();
        $desas = Desa::all();

        return view('superadmin.ekonomi.create', compact('kategoris','ekonomi', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EkonomiRequest $request): RedirectResponse
    {
        Ekonomi::create($request->validated());

        return Redirect::route('superadmin.ekonomi.index')
            ->with('success', 'Ekonomi created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $ekonomi = Ekonomi::find($id);

        return view('superadmin.ekonomi.show', compact('ekonomi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $kategoris = Kategori::all();
        $ekonomi = Ekonomi::find($id);
        $desas = Desa::all();

        return view('superadmin.ekonomi.edit', compact('kategoris','ekonomi', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EkonomiRequest $request, Ekonomi $ekonomi): RedirectResponse
    {
        $ekonomi->update($request->validated());

        return Redirect::route('superadmin.ekonomi.index')
            ->with('success', 'Ekonomi updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Ekonomi::find($id)->delete();

        return Redirect::route('superadmin.ekonomi.index')
            ->with('success', 'Ekonomi deleted successfully');
    }
}
