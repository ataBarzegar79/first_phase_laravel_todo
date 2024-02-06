<?php

namespace App\Http\Controllers;

use App\Http\Requests\{IndexTaskRequest, StoreTaskRequest, UpdateTaskRequest};
use App\Models\Task;
use App\Enums\Status;
use Illuminate\Support\Facades\Config;

class TaskController extends Controller
{

    public function create()
    {
        return view('create');
    }

    public function store(StoreTaskRequest $StoreRequest)
    {
        $StoreRequest->validated();

        Task::create
        ([
            'user_id' => request()->user()->id,
            'title' => $StoreRequest['title'],
            'body' => $StoreRequest['body'],
            'started_at' => $StoreRequest['start_time'],
            'ended_at' => $StoreRequest['end_time'],
            'status' => Status::inProgress,
            'completed_at' => null,
        ]);
        session()->flash('success', __('messages.store_success'));
        return to_route('task.index');
    }

    public function index(IndexTaskRequest $IndexRequest, Task $tasks)
    {
        // Validate filters
        $IndexRequest->validated();

        // Get the filter, sort, and order variables from the request or use the default values
        $filter = $IndexRequest->input('filter', 'All');
        $sort = $IndexRequest->input('sort', 'created_at');
        $order = $IndexRequest->input('order', 'desc');

        // Apply the filter condition if it is not null or empty
        if ($filter !== Status::all->value)
        {
            // If the filter is 0, show only the tasks that are in progress
            if ($filter === Status::inProgress->value)
            {
                $tasks = $tasks->where('status', $filter);
            }

            // If the filter is 1, show only the tasks that are done within the current week
            if ($filter === Status::done->value)
                $tasks = $tasks->where('status', $filter)
                    ->whereDate('ended_at', '>', now()->startOfWeek());

        }
        else
        {
            // If the filter is All, show all in progress tasks and all done tasks that completed within this week
            $tasks = $tasks->where(function (){Task::all();});
        }

        // Apply the sort and order conditions
        $tasks = $tasks->orderBy($sort, $order);
        // Paginate the results by 10 per page
        $tasks = $tasks->paginate(config::get('pagination.per_page'));

        // Return the manage.blade.php view with the tasks collection
        return view('manage', ['tasks' => $tasks]);
    }


    public function destroy(Task $task)
    {
        // Delete the task from the database
        $task->delete();

        // Redirect back to the manage view with a success message
        session()->flash('success', __('messages.destroy_success'));
        return to_route('task.index');
    }

    public function edit(Task $task)
    {
        return view('update', ["task" => $task]);
    }

    public function update(Task $task, UpdateTaskRequest $updateRequest)
    {
        $updateRequest->validated();

        $task->fill(request()->all());
        $task->completed_at = now();

        $task->save();
        session()->flash('success', __('messages.update_success'));
        return to_route('task.index');

    }

}
