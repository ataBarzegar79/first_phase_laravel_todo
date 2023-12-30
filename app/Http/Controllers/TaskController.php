<?php

namespace App\Http\Controllers;


use App\Enums\TaskStatus;
use App\Http\Requests\IndexTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Carbon\Carbon;
use Config;

class TaskController extends Controller
{
    public function index(IndexTaskRequest $request)
    {
        $request->validated();
        $user = auth()->user();
        $tasksQuery = $user->tasks();
        $tasksQuery = $tasksQuery->latest('deadline');
        $search = request('search') ?? false;
        $tasksQuery = $tasksQuery->where(function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            })->orWhere(function ($q) use ($search) {
                $q->orWhere('description', 'like', '%' . $search . '%');
            });
        });
        switch ($request['status']):
            case (TaskStatus::Complete->value):
                $tasksQuery->complete();
                break;
            case (TaskStatus::Incomplete->value):
                $tasksQuery->incomplete();
                break;
            default:
                $tasksQuery->where(function ($query) {
                    $query->where(function ($q) {
                        $q->complete();
                    })->orWhere(function ($q) {
                        $q->incomplete();
                    });
                });
        endswitch;

        $tasks = $tasksQuery
            ->paginate(request('paginate') ?? Config::get('view.paginate'))
            ->withQueryString();
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = array_merge($request->validated(), [
            'user_id' => auth()->id(),
            'status' => TaskStatus::Incomplete,
        ]);
        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', __('messages.create', ['name' => 'Task']));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    public function update(Task $task, UpdateTaskRequest $request)
    {
        $validated = array_merge(
            $request->validated(), [
                'completed_on' => request('status') === TaskStatus::Complete->value ? Carbon::now() : null
            ]
        );
        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', __('messages.update', ['name' => 'Task']));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', __('messages.delete', ['name' => 'Task']));
    }
}
