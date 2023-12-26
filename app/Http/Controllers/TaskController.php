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
            'status' => false,
            'completed_at' => null,
        ]);
        session()->flash('success', 'Task Added Successfully!');
        return to_route('manage');
    }

    public function index()
    {
        $sort = request('sort', 'created_at'); // get the sort parameter or use the default value 'created_at'
        $order = request('order', 'desc'); // get the order parameter or use the default value 'desc'
        $filter = request('filter', null); // get the filter parameter or use the default value null
        if($filter)
            $tasks = Task::where('user_id', auth()->user()->id)->whereDate('finishing_time', '>', now()->subWeek())->orderBy($sort, $order)->where('status', $filter)->paginate(10);
        else
            $tasks = Task::where('user_id', auth()->user()->id)->whereDate('finishing_time', '>', now()->subWeek())->orderBy($sort, $order)->paginate(10);
        return view('manage', compact('tasks'));
    }

    public function destroy($slug)
    {
        // Find the task by its slug
        $task = Task::where('slug', $slug)->firstOrFail();

        // Delete the task from the database
        $task->delete();

        // Redirect back to the manage view with a success message
        session()->flash('success', 'Task deleted successfully!');
        return redirect()->route('manage');
    }
}
