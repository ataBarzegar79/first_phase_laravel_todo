<?php

namespace App\Models;

use App\Models\Scopes\TaskScope;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Factories\HasFactory};

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new TaskScope);
    }

}
