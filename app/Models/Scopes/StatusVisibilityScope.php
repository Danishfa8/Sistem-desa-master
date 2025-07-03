<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class StatusVisibilityScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        if (!$user) {
            return;
        }

        if ($user->hasAnyRole(['superadmin', 'admin_kabupaten'])) {
            $builder->whereIn('status', ['Pending', 'Approved', 'Rejected']);
        } elseif ($user->hasRole('admin_desa')) {
            $builder->whereIn('status', ['Arsip', 'Pending', 'Approved', 'Rejected']);
        } else {
            // Role lain hanya bisa melihat yang approved
            $builder->where('status', 'Approved');
        }
    }
}
