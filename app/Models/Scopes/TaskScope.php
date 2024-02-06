<?php

namespace App\Models\Scopes;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TaskScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('status', Status::inProgress->value)
        ->orWhere(function ($query)
        {
            $query->where('status', Status::done->value)
                ->whereDate('ended_at', '>', now()->startOfWeek());
        });
    }
}
