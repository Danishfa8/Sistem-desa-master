<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;

use App\Models\ProfileDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileDesaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $profileDesas = ProfileDesa::paginate();

        return view('admin_desa.desa.profile-desa.index', compact('profileDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $profileDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($desa_id): View
    {
        $profileDesa = new ProfileDesa();
        $profileDesa->desa_id = $desa_id;

        return view('admin_desa.desa.profile-desa.create', compact('profileDesa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileDesaRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if (request()->hasFile('foto')) {
            $foto = request()->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('profile-desa', $fotoName, 'public');

            $validatedData['foto'] = 'profile-desa/' . $fotoName;
        }

        ProfileDesa::create($validatedData);

        return Redirect::route('admin_desa.desas.index')
            ->with('success', 'ProfileDesa berhasil dibuat dengan foto.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $profileDesa = ProfileDesa::find($id);

        return view('admin_desa.desa.profile-desa.show', compact('profileDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $profileDesa = ProfileDesa::find($id);

        return view('admin_desa.desa.profile-desa.edit', compact('profileDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileDesaRequest $request, ProfileDesa $profileDesa): RedirectResponse
    {
        $profileDesa->update($request->validated());

        return Redirect::route('admin_desa.profile-desas.index')
            ->with('success', 'ProfileDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ProfileDesa::find($id)->delete();

        return Redirect::route('admin_desa.profile-desas.index')
            ->with('success', 'ProfileDesa deleted successfully');
    }
}
