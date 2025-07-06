<?php

namespace App\Http\Controllers\admindesa;

use App\Http\Controllers\Controller;
use App\Models\Kebudayaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\KebudayaanRequest;
use App\Models\Desa;
use App\Models\Kategori;
use App\Models\RtRwDesa;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class KebudayaanDesa extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $budayas = Kebudayaan::with('desa')->paginate();

        return view('admin_desa.budaya.index', compact('budayas'))
            ->with('i', ($request->input('page', 1) - 1) * $budayas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kategoris = Kategori::all();
        $budayas = new Kebudayaan();
        $desas = Desa::all();
        $rtRwDesa = RtRwDesa::all();

        return view('admin_desa.budaya.create', compact('kategoris','budayas', 'desas'));
    }
        public function getRtRw($desa_id): JsonResponse
        {
            $rtRw = RtRwDesa::where('desa_id', $desa_id)->get();

            $rtRw->map(function ($item) {
                $item->rt_rw = "RT {$item->rt} / RW {$item->rw}";
                return $item;
            });

            return response()->json($rtRw);
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KebudayaanRequest $request): RedirectResponse
    {
        Kebudayaan::create($request->validated());

        return Redirect::route('admin_desa.budaya.index')
            ->with('success', 'Kebudayaan Desa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $budayas = Kebudayaan::find($id);

        return view('admin_desa.budaya.show', compact('budayas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $kategoris = Kategori::all();
        $budayas = Kebudayaan::find($id);
        $desas = Desa::all();

        return view('admin_desa.budaya.edit', compact('kategoris','budayas', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KebudayaanRequest $request, Kebudayaan $budaya): RedirectResponse
    {
        $budaya->update($request->validated());

        return Redirect::route('admin_desa.budaya.index')
            ->with('success', 'Kebudayaan Desa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Kebudayaan::find($id)->delete();

        return Redirect::route('admin_desa.budaya.index')
            ->with('success', 'Kebudayaan Desa deleted successfully');
    }
}
