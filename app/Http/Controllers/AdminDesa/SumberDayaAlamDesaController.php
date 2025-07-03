<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\SumberDayaAlamDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SumberDayaAlamDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SumberDayaAlamDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sumberDayaAlamDesas = SumberDayaAlamDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.sumber-daya-alam-desa.index', compact('sumberDayaAlamDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $sumberDayaAlamDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sumberDayaAlamDesa = new SumberDayaAlamDesa();
        $desas = Desa::all();

        return view('admin_desa.sumber-daya-alam-desa.create', compact('sumberDayaAlamDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SumberDayaAlamDesaRequest $request): RedirectResponse
    {
        SumberDayaAlamDesa::create($request->validated());

        return Redirect::route('admin_desa.sumber-daya-alam-desa.index')
            ->with('success', 'SumberDayaAlamDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $sumberDayaAlamDesa = SumberDayaAlamDesa::find($id);

        return view('admin_desa.sumber-daya-alam-desa.show', compact('sumberDayaAlamDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $sumberDayaAlamDesa = SumberDayaAlamDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.sumber-daya-alam-desa.edit', compact('sumberDayaAlamDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SumberDayaAlamDesaRequest $request, SumberDayaAlamDesa $sumberDayaAlamDesa): RedirectResponse
    {
        $sumberDayaAlamDesa->update($request->validated());

        return Redirect::route('admin_desa.sumber-daya-alam-desa.index')
            ->with('success', 'SumberDayaAlamDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        SumberDayaAlamDesa::find($id)->delete();

        return Redirect::route('admin_desa.sumber-daya-alam-desa.index')
            ->with('success', 'SumberDayaAlamDesa deleted successfully');
    }
}
