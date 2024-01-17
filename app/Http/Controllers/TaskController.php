<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
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
            'title' => request('title'), // todo : you have already access to your query parameters from StoreTaskRequest.
            'body' => request('body'),
            'started_at' => request('start_time'),
            'ended_at' => request('end_time'),
            'slug' => Str::slug(request('title'), '-'),
            'status' => 'In Progress', // todo : use enums and map them to your models(Task model)
            'completed_at' => null,
        ]);
        session()->flash('success', 'Task Added Successfully!'); // todo : use language files.
        return to_route('manage');
    }

    public function index(Request $request)
    {
        // Get the filter, sort, and order variables from the request or use the default values
        // todo : you must also validation request class for your index method !
        $filter = $request->input('filter', null);
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

        // Query the tasks that belong to the authenticated user
        $tasks = Task::where('user_id', auth()->id()); // todo : you also have access to users via tasks() in your model.

        // Apply the filter condition if it is not null or empty
        if (!empty($filter)) { // todo : you have to use is_null built-in function, since you have set a null as a default in line 42.

            // If the filter is 0, show only the tasks that are in progress
            if ($filter === "In Progress") // todo : map your task status into enums in php and associate them into your model in Laravel.
                $tasks = $tasks->where('status', $filter);

            // If the filter is 1, show only the tasks that are done within the current week
            if ($filter === "Done") // todo : map your task status into enums in php and associate them into your model in Laravel.
                $tasks = $tasks->where('status', $filter)
                    ->whereDate('ended_at', '>', now()->startOfWeek());

        } else {
            // If the filter is null, show all in progress tasks and all done tasks that completed within this week
            $tasks = $tasks->where(function ($query) {
                $query->where('status', 'In Progress') // todo : use scopes in models : https://laravel.com/docs/10.x/eloquent#query-scopes
                    ->orWhere(function ($query) {
                        $query->where('status', 'Done')
                            ->whereDate('ended_at', '>', now()->startOfWeek());
                    });
            });
        }

        // Apply the sort and order conditions
        $tasks = $tasks->orderBy($sort, $order);
        // Paginate the results by 10 per page
        $tasks = $tasks->paginate(config('pagination.per_page')); //todo : you should use Config facade.
        // Return the Manage.blade.php view with the tasks collection
        return view('Manage', ['tasks' => $tasks]); //todo : you have a error on this page. it seems that your view page name isn't set correctly.
    }


    public function destroy(Task $task)
    {
        // Find the task by its id
        $task = Task::where('id', $task->id)->firstOrFail(); // todo : you have already retrieved your task in your input of destroy method, so you don't need a query anymore.

        // Delete the task from the database
        $task->delete();

        // Redirect back to the manage view with a success message
        session()->flash('success', 'Task deleted successfully!'); // todo :  you have to use language files existed in Laravel : https://laravel.com/docs/10.x/localization
        return to_route('manage');
    }

    public function edit(Task $task)
    {
        $task = Task::where('id', $task->id)->firstOrFail(); // todo : you have already retrieved your task in your input of destroy method, so you don't need a query anymore.
        return view('update', ["task" => $task]);
    }

    public function update(Task $task, UpdateTaskRequest $updateRequest)
    {

        $data = $updateRequest->validated(); // todo : Dont define

        $task = Task::where('id', $task->id)->firstOrFail(); // todo : you have already retrieved your task in your input of destroy method, so you don't need a query anymore.

        $task->fill(request()->all());
        $task->completed_at = now();

        $task->save();

        session()->flash('success', 'Task Updated Successfully!'); // todo : you have to use localization files
        return to_route('manage');
    }

}
