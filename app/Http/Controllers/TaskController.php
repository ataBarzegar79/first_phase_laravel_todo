<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        // Get the filter, sort, and order variables from the request or use the default values
        $filter = $request->input('filter', null);
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

        // Query the tasks that belong to the authenticated user
        $tasks = Task::where('user_id', auth()->id());

        // Apply the filter condition if it is not null or empty
        if (!empty($filter))
        {

            // If the filter is 0, show only the tasks that are in progress
            if ($filter === "In Progress")
                $tasks = $tasks->where('status', $filter);

            // If the filter is 1, show only the tasks that are done within the current week
            if ($filter === "Done")
                $tasks = $tasks->where('status', $filter)
                    ->whereDate('ended_at', '>', now()->startOfWeek());

        }
        else
        {
            // If the filter is null, show all in progress tasks and all done tasks that completed within this week
            $tasks = $tasks->where(function ($query)
            {
                $query->where('status', 'In Progress')
                    ->orWhere(function ($query)
                    {
                        $query->where('status', 'Done')
                            ->whereDate('ended_at', '>', now()->startOfWeek());
                    });
            });
        }

        // Apply the sort and order conditions
        $tasks = $tasks->orderBy($sort, $order);

        // Paginate the results by 10 per page
        $tasks = $tasks->paginate(10);

        // Return the Manage.blade.php view with the tasks collection
        return view('Manage', ['tasks' => $tasks]);
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
