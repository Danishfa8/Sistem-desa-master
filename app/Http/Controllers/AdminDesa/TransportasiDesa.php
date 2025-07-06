<?php

namespace App\Http\Controllers\admindesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TransportasiRequest;
use App\Models\Desa;
use App\Models\Kategori;
use App\Models\RtRwDesa;
use App\Models\Transportasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;


class TransportasiDesa extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $transportasi = Transportasi::with('desa')->paginate();

        return view('admin_desa.transportasi.index', compact('transportasi'))
            ->with('i', ($request->input('page', 1) - 1) * $transportasi->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kategoris = Kategori::all();
        $transportasi = new Transportasi();
        $desas = Desa::all();
        $rtRwDesa = RtRwDesa::all();


        return view('admin_desa.transportasi.create', compact('kategoris', 'transportasi', 'desas', 'rtRwDesa'));
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
    public function store(TransportasiRequest $request): RedirectResponse
    {
        Transportasi::create($request->validated());

        return Redirect::route('admin_desa.transportasi.index')
            ->with('success', 'Transportasi Desa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $transportasi = Transportasi::find($id);

        return view('admin_desa.transportasi.show', compact('transportasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $kategoris = Kategori::all();
        $transportasi = Transportasi::find($id);
        $desas = Desa::all();
        $rtRwDesa = RtRwDesa::all();

        return view('admin_desa.transportasi.edit', compact('kategoris', 'transportasi', 'desas', 'rtRwDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransportasiRequest $request, Transportasi $transportasi): RedirectResponse
    {
        $transportasi->update($request->validated());

        return Redirect::route('admin_desa.transportasi.index')
            ->with('success', 'Transportasi Desa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Transportasi::find($id)->delete();

        return Redirect::route('admin_desa.transportasi.index')
            ->with('success', 'TransportasiDesa deleted successfully');
    }
}
