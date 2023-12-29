<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\{Task};
use Str;

class TaskController extends Controller
{

    public function create()
    {
        return view('create');
    }

    public function store(StoreTaskRequest $StoreRequest)
    {
        $data = $StoreRequest->validated();

        Task::create
        ([
            'user_id' => request()->user()->id,
            'title' => request('title'),
            'body' => request('body'),
            'started_at' => request('start_time'),
            'ended_at' => request('end_time'),
            'slug' => Str::slug(request('title'), '-'),
            'status' => 'In Progress',
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

        $tasks = Task::whereHas('user', function ($query) {
            $query->whereKey(Auth::user()->tasks()->pluck('id'));
        })
            ->orderBy($sort, $order)
            ->where('status', $filter)
            ->paginate(10); // paginate the query results by 10 per page

        if($filter === "1")
            $tasks = $tasks->whereDate('ended_at', '>', now()->subWeek());

        return view('manage',
            [
                'tasks' => $tasks
            ]);
    }


    public function destroy(Task $task)
    {
        // Find the task by its id
        $task = Task::where('id', $task->id)->firstOrFail();

        // Delete the task from the database
        $task->delete();

        // Redirect back to the manage view with a success message
        session()->flash('success', 'Task deleted successfully!');
        return to_route('manage');
    }

    public function edit(Task $task)
    {
        $task = Task::where('id', $task->id)->firstOrFail();
        return view('update', ["task" => $task]);
    }

    public function update(Task $task, UpdateTaskRequest $updateRequest)
    {

        $data = $updateRequest->validated();

        $task = Task::where('id', $task->id)->firstOrFail();

        $task->fill(request()->all());
        $task->completed_at = now();

        $task->save();

        session()->flash('success', 'Task Updated Successfully!');
        return to_route('manage');
    }

}
