<?php

namespace App\Observers;

use App\Models\KelembagaanDesa;
use Illuminate\Support\Facades\Auth;

class KelembagaanDesaObserver
{
    /**
     * Handle the KelembagaanDesa "created" event.
     */
    public function created(KelembagaanDesa $kelembagaanDesa): void
    {
        $kelembagaanDesa->created_by = Auth::user()->name;
        $kelembagaanDesa->updated_by = Auth::user()->name;
    }

    /**
     * Handle the KelembagaanDesa "updated" event.
     */
    public function updated(KelembagaanDesa $kelembagaanDesa): void
    {
        $kelembagaanDesa->updated_by = Auth::user()->name;
    }

    /**
     * Handle the KelembagaanDesa "deleted" event.
     */
    public function deleted(KelembagaanDesa $kelembagaanDesa): void
    {
        //
    }

    /**
     * Handle the KelembagaanDesa "restored" event.
     */
    public function restored(KelembagaanDesa $kelembagaanDesa): void
    {
        //
    }

    /**
     * Handle the KelembagaanDesa "force deleted" event.
     */
    public function forceDeleted(KelembagaanDesa $kelembagaanDesa): void
    {
        //
    }
}
