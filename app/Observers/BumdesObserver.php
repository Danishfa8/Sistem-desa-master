<?php

namespace App\Observers;

use App\Models\bumde;
use Illuminate\Support\Facades\Auth;

class BumdesObserver
{
    /**
     * Handle the bumde "created" event.
     */
    public function created(bumde $bumde): void
    {
        $bumde->created_by = Auth::user()->name;
        $bumde->updated_by = Auth::user()->name;
    }

    /**
     * Handle the bumde "updated" event.
     */
    public function updated(bumde $bumde): void
    {
        $bumde->updated_by = Auth::user()->name;
    }

    /**
     * Handle the bumde "deleted" event.
     */
    public function deleted(bumde $bumde): void
    {
        //
    }

    /**
     * Handle the bumde "restored" event.
     */
    public function restored(bumde $bumde): void
    {
        //
    }

    /**
     * Handle the bumde "force deleted" event.
     */
    public function forceDeleted(bumde $bumde): void
    {
        //
    }
}
