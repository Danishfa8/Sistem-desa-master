<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\Bumde;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BumdeRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BumdeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $bumdes = Bumde::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.bumdes.index', compact('bumdes'))
            ->with('i', ($request->input('page', 1) - 1) * $bumdes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $bumde = new Bumde();
        $desas = Desa::all();

        return view('admin_desa.bumdes.create', compact('bumde', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BumdeRequest $request): RedirectResponse
    {
        Bumde::create($request->validated());

        return Redirect::route('admin_desa.bumdes.index')
            ->with('success', 'Bumde created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $bumde = Bumde::find($id);

        return view('admin_desa.bumdes.show', compact('bumde'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $bumde = Bumde::find($id);
        $desas = Desa::all();

        return view('admin_desa.bumdes.edit', compact('bumde', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BumdeRequest $request, Bumde $bumde): RedirectResponse
    {
        $bumde->update($request->validated());

        return Redirect::route('admin_desa.bumdes.index')
            ->with('success', 'Bumde updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Bumde::find($id)->delete();

        return Redirect::route('admin_desa.bumdes.index')
            ->with('success', 'Bumde deleted successfully');
    }
}
