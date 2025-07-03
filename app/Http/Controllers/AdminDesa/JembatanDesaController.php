<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\JembatanDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\JembatanDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class JembatanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $jembatanDesas = JembatanDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.jembatan-desa.index', compact('jembatanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $jembatanDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jembatanDesa = new JembatanDesa();
        $desas = Desa::all();

        return view('admin_desa.jembatan-desa.create', compact('jembatanDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JembatanDesaRequest $request): RedirectResponse
    {
        JembatanDesa::create($request->validated());

        return Redirect::route('admin_desa.jembatan-desa.index')
            ->with('success', 'JembatanDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $jembatanDesa = JembatanDesa::find($id);

        return view('admin_desa.jembatan-desa.show', compact('jembatanDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $jembatanDesa = JembatanDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.jembatan-desa.edit', compact('jembatanDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JembatanDesaRequest $request, JembatanDesa $jembatanDesa): RedirectResponse
    {
        $jembatanDesa->update($request->validated());

        return Redirect::route('admin_desa.jembatan-desa.index')
            ->with('success', 'JembatanDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        JembatanDesa::find($id)->delete();

        return Redirect::route('admin_desa.jembatan-desa.index')
            ->with('success', 'JembatanDesa deleted successfully');
    }
}
