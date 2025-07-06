<?php

namespace App\Http\Controllers\admindesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProdukUnggulanRequest;
use App\Models\Desa;
use App\Models\Kategori;
use App\Models\ProdukUnggulan;
use App\Models\RtRwDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;


class ProdukUnggulanDesa extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $produk = ProdukUnggulan::with('desa')->paginate();

        return view('admin_desa.produk.index', compact('produk'))
            ->with('i', ($request->input('page', 1) - 1) * $produk->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kategoris = Kategori::all();
        $produk = new ProdukUnggulan();
        $desas = Desa::all();
        $rtRwDesa = RtRwDesa::all();

        return view('admin_desa.produk.create', compact('kategoris','produk', 'desas','rtRwDesa'));
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
    public function store(ProdukUnggulanRequest $request): RedirectResponse
    {
        ProdukUnggulan::create($request->validated());

        return Redirect::route('admin_desa.produk.index')
            ->with('success', 'Produk Unggulan Desa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $produk = ProdukUnggulan::find($id);

        return view('admin_desa.produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $kategoris = Kategori::all();
        $produk = ProdukUnggulan::find($id);
        $desas = Desa::all();
        $rtRwDesa = RtRwDesa::all();

        return view('admin_desa.produk.edit', compact('kategoris','produk', 'desas','rtRwDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdukUnggulanRequest $request, ProdukUnggulan $produk): RedirectResponse
    {
        $produk->update($request->validated());

        return Redirect::route('admin_desa.produk.index')
            ->with('success', 'Produk Unggulan Desa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ProdukUnggulan::find($id)->delete();

        return Redirect::route('admin_desa.produk.index')
            ->with('success', 'Produk Unggulan Desa deleted successfully');
    }
}
