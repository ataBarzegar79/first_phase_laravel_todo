<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Config;
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
        $query->when($filters['status'] ?? false,
            fn($query, $status) => $query->where('status', '=', $status)
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

    public function scopeFilteredTask(Builder $query): void
    {
        $query->where(
            function (Builder $query) {
                $query
                    ->incomplete()
                    ->orWhere(function (Builder $query) {
                        $query
                            ->complete()
                            ->whereDate('completed_on', '>', now()->subDays(Config::get('view.completeDay')));
                    });
            }
        );
    }

}
