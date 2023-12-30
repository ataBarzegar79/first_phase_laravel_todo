<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory,SoftDeletes;

    protected  $fillable = ['user_id','title','task_status','description','deadline'];

    public function scopeFilter($query): void
    {
        $query->whereNot(function ($query) {
            $query
                ->where('task_status', '=', 'Completed')
                ->whereDate('deadline', '<', Carbon::now()->subDays(7));
        });
    }

    public function scopeSearch($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(fn($query) => $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%'));
        });
    }

    public function scopeSelect($query, array $filters)
    {
        $query->when($filters['select'] ?? false, function ($query, $select) {
            $query
                ->whereExists(fn($query) => $query
                    ->where('task_status', '=', $select));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
