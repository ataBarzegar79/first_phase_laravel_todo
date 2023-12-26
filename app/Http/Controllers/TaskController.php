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
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        Task::create
        ([
            'user_id' => \request()->user()->id,
            'title' => \request('title'),
            'body' => \request('body'),
            'starting_time' => \request('start_time'),
            'finishing_time' => \request('end_time'),
            'slug' => Str::slug(\request('title'), '-'),
            'status' => false
        ]);
        session()->flash('success', 'Task Added Successfully!');
        return to_route('manage');
    }

    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->paginate(10);
        return view('manage', compact('tasks'));
    }

    public function destroy($id)
    {
        // Find the task by its id
        $task = Task::findOrFail($id);

        // Delete the task from the database
        $task->delete();

        // Redirect back to the manage view with a success message
        session()->flash('success', 'Task deleted successfully!');
        return redirect()->route('manage');
    }
}
