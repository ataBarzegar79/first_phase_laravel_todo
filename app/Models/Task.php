<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['search'] ?? false,
            fn($query, $search) => $query->where(
                fn($query) => $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
            )
        );
        $query->when($filters['status'] ?? false,
            fn($query, $status) => $query->where(
                fn($query) => $query->where('status', 'like', $status)
            )
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
