<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\SaranaLainyaDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SaranaLainyaDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SaranaLainyaDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $saranaLainyaDesas = SaranaLainyaDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.sarana-lainya-desa.index', compact('saranaLainyaDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $saranaLainyaDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $saranaLainyaDesa = new SaranaLainyaDesa();
        $desas = Desa::all();

        return view('admin_desa.sarana-lainya-desa.create', compact('saranaLainyaDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaranaLainyaDesaRequest $request): RedirectResponse
    {
        SaranaLainyaDesa::create($request->validated());

        return Redirect::route('admin_desa.sarana-lainya-desa.index')
            ->with('success', 'SaranaLainyaDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $saranaLainyaDesa = SaranaLainyaDesa::find($id);

        return view('admin_desa.sarana-lainya-desa.show', compact('saranaLainyaDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $saranaLainyaDesa = SaranaLainyaDesa::find($id);
        $desas = Desa::all();

        return view('sarana-lainya-desa.edit', compact('saranaLainyaDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaranaLainyaDesaRequest $request, SaranaLainyaDesa $saranaLainyaDesa): RedirectResponse
    {
        $saranaLainyaDesa->update($request->validated());

        return Redirect::route('admin_desa.sarana-lainya-desa.index')
            ->with('success', 'SaranaLainyaDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        SaranaLainyaDesa::find($id)->delete();

        return Redirect::route('admin_desa.sarana-lainya-desa.index')
            ->with('success', 'SaranaLainyaDesa deleted successfully');
    }
}
