<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\KelembagaanDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\KelembagaanDesaRequest;
use App\Models\Desa;
use App\Models\RtRwDesa;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class KelembagaanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $kelembagaanDesas = KelembagaanDesa::with('desa', 'rtRwDesa')->paginate();

        return view('admin_desa.kelembagaan-desa.index', compact('kelembagaanDesas'))
            ->with('i', ($request->input('page', 1) - 1) * $kelembagaanDesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kelembagaanDesa = new KelembagaanDesa();
        $desas = Desa::all();
        $rtRwDesa = RtRwDesa::all();

        return view('admin_desa.kelembagaan-desa.create', compact('kelembagaanDesa', 'desas', 'rtRwDesa'));
    }

    /**
     * Get RT/RW by Desa ID
     */

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
    public function store(KelembagaanDesaRequest $request): RedirectResponse
    {
        KelembagaanDesa::create($request->validated());

        return Redirect::route('admin_desa.kelembagaan-desa.index')
            ->with('success', 'KelembagaanDesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $kelembagaanDesa = KelembagaanDesa::find($id);

        return view('admin_desa.kelembagaan-desa.show', compact('kelembagaanDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $kelembagaanDesa = KelembagaanDesa::find($id);
        $desas = Desa::all();

        return view('admin_desa.kelembagaan-desa.edit', compact('kelembagaanDesa', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelembagaanDesaRequest $request, KelembagaanDesa $kelembagaanDesa): RedirectResponse
    {
        $kelembagaanDesa->update($request->validated());

        return Redirect::route('admin_desa.kelembagaan-desa.index')
            ->with('success', 'KelembagaanDesa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        KelembagaanDesa::find($id)->delete();

        return Redirect::route('admin_desa.kelembagaan-desa.index')
            ->with('success', 'KelembagaanDesa deleted successfully');
    }
}
