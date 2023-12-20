<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query,array $filters): void
    {
        $query->when($filters['search'] ?? false,function ($query,$search){
            $query->where(fn($query) =>
            $query->where('title' , 'like' , '%' . $search . '%')
                ->orWhere('slug', 'like' , '%' . $search . '%'));
        });
        $query->whereNot(function ($query) {
            $query
                ->where('select', '=', 'Completed')
                ->whereDate('time', '<', Carbon::now()->subDays(7));
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
