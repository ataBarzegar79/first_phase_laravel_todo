<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function scopeSearch($query, ?string $content): void //todo : scopes are used for only frequently used queries , omit this .
    {
        $query->when($content ?? false,
            fn($query, $content) => $query
                ->where('title', 'like', '%' . $content . '%')
                ->orWhere('description', 'like', '%' . $content . '%')
        );
    }

    public function scopeIncomplete(Builder $query): void
    {
        $query->where('status', '=', TaskStatus::Incomplete->value);
    }

    public function scopeComplete(Builder $query): void
    {
        $query->where('status', '=', TaskStatus::Complete->value)
            ->where('completed_on', '>=', Carbon::now()->subDays(Config::get('view.completeDay')));
    }
}
