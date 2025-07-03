<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\JalanDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\JalanDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class JalanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $jalanDesas = JalanDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.jalan-desa.index', compact('jalanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $jalanDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jalanDesa = new JalanDesa();
        $desas = Desa::all();

        return view('admin_desa.jalan-desa.create', compact('jalanDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JalanDesaRequest $request): RedirectResponse
    {
        JalanDesa::create($request->validated());

        return Redirect::route('admin_desa.jalan-desa.index')
            ->with('success', 'JalanDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $jalanDesa = JalanDesa::find($id);

        return view('admin_desa.jalan-desa.show', compact('jalanDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $jalanDesa = JalanDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.jalan-desa.edit', compact('jalanDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JalanDesaRequest $request, JalanDesa $jalanDesa): RedirectResponse
    {
        $jalanDesa->update($request->validated());

        return Redirect::route('admin_desa.jalan-desa.index')
            ->with('success', 'JalanDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        JalanDesa::find($id)->delete();

        return Redirect::route('admin_desa.jalan-desa.index')
            ->with('success', 'JalanDesa deleted successfully');
    }
}
