<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    use HasFactory;

    protected $guarded = []; // todo : don't put your Tas as Guarded free.

    public function scopeFilter($query, array $filters): void
    { //todo : this is not a true usages of scope , since we use them when we aim to use a query frequently. this query will be used just for indexing ! : https://laravel.com/docs/10.x/eloquent#:~:text=common%20sets%20of%20query%20constraints%20that%20you%20may%20easily%20re%2Duse%20throughout%20your%20application.
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(fn($query) => $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%'));
        });
        $query->whereNot(function ($query) {
            $query
                ->where('task_status', '=', 'Completed')
                ->whereDate('deadline', '<', Carbon::now()->subDays(7));
        });
        $query->when($filters['select'] ?? false, function ($query, $select) {
            $query
                ->whereExists(fn($query) => $query
                    ->where('task_status', '=', $select));
        });
    } // todo: don't copy your code !

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
