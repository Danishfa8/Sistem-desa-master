<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\PendidikanDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PendidikanDesaRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PendidikanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pendidikanDesas = PendidikanDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.pendidikan-desa.index', compact('pendidikanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $pendidikanDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pendidikanDesa = new PendidikanDesa();
        $desas = Desa::all();

        return view('admin_desa.pendidikan-desa.create', compact('pendidikanDesa', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendidikanDesaRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if (request()->hasFile('foto')) {
            $foto = request()->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('pendidikan-desa', $fotoName, 'public');

            $validatedData['foto'] = 'pendidikan-desa/' . $fotoName;
        }

        PendidikanDesa::create($validatedData);

        return Redirect::route('admin_desa.pendidikan-desa.index')
            ->with('success', 'ProfileDesa berhasil dibuat dengan foto.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $pendidikanDesa = PendidikanDesa::find($id);

        return view('admin_desa.pendidikan-desa.show', compact('pendidikanDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pendidikanDesa = PendidikanDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.pendidikan-desa.edit', compact('pendidikanDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendidikanDesaRequest $request, PendidikanDesa $pendidikanDesa): RedirectResponse
    {
        $pendidikanDesa->update($request->validated());

        return Redirect::route('admin_desa.pendidikan-desa.index')
            ->with('success', 'PendidikanDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        PendidikanDesa::find($id)->delete();

        return Redirect::route('admin_desa.pendidikan-desa.index')
            ->with('success', 'PendidikanDesa deleted successfully');
    }
}
