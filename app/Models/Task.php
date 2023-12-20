<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['search'] ?? false,
            fn($query, $search) => $query->where(
                fn($query) => $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
            )
        );
        $query->when($filters['status'] ?? false, //todo : this part of your query looks to be unnecessary or even wrong since you have only 2 types of statuses
            fn($query, $status) => $query->where(
                fn($query) => $query->where('status', 'like', $status)
            )
        );
    }
    public function scopeIncomplete(Builder $query): void
    {
        $query->where('status', '=', 'INCOMPLETE');
    }
    public function scopeComplete(Builder $query): void
    {
        $query->where('status', '=', 'COMPLETE');
    }

}
