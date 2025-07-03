<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Lpmdk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LpmdkRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LpmdkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $lpmdks = Lpmdk::with('desa', 'rtRwDesa')->paginate();

        return view('superadmin.lpmdk.index', compact('lpmdks'))
            ->with('i', ($request->input('page', 1) - 1) * $lpmdks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $lpmdk = new Lpmdk();
        $desas = Desa::all();

        return view('superadmin.lpmdk.create', compact('lpmdk', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LpmdkRequest $request): RedirectResponse
    {
        Lpmdk::create($request->validated());

        return Redirect::route('superadmin.lpmdk.index')
            ->with('success', 'Lpmdk created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $lpmdk = Lpmdk::find($id);

        return view('superadmin.lpmdk.show', compact('lpmdk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $lpmdk = Lpmdk::find($id);
        $desas = Desa::all();


        return view('superadmin.lpmdk.edit', compact('lpmdk', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LpmdkRequest $request, Lpmdk $lpmdk): RedirectResponse
    {
        $lpmdk->update($request->validated());

        return Redirect::route('superadmin.lpmdk.index')
            ->with('success', 'Lpmdk updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Lpmdk::find($id)->delete();

        return Redirect::route('superadmin.lpmdk.index')
            ->with('success', 'Lpmdk deleted successfully');
    }
}
