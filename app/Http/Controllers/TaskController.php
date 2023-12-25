<?php

namespace App\Http\Controllers;

use App\Models\Task;
use DateTime;
use Illuminate\Http\Request;
use Str;

class TaskController extends Controller
{
    public function store()
    {
        \request()->validate([
            'body'=> 'required',
            'title' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Task::create
        ([
            'user_id' => \request()->user()->id,
            'title' => \request('title'),
            'body' => \request('body'),
            'starting_time' => \request('start_time'),
            'finishing_time' => \request('end_time'),
            'slug' => Str::slug(\request('title'), '-'),
        ]);
        return to_route('show-all');
    }
}
