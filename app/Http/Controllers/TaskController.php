<?php

namespace App\Http\Controllers;


use App\Enums\TaskStatus;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Carbon\Carbon;
use Config;
use Illuminate\Database\Eloquent\Builder;
use function request;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index', [
            'tasks' => auth()->user()->tasks()
                ->latest('deadline')
                ->filter(request(['search', 'status']))
                ->filteredTask()
                ->paginate(request('paginate') ?? Config::get('view.paginate'))
                ->withQueryString()
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
