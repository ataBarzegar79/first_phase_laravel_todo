<?php

namespace App\Http\Controllers;


use App\Models\Task;
use Carbon\Carbon;
use function request;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index', [
            'tasks' => auth()->user()->tasks()
                ->latest('deadline')
                ->filter(request(['search', 'status']))
                ->where(function ($query) {
                    $query->where('status', '!=', 'COMPLETE')
                        ->orWhere(function ($query) {
                            $query->where('status', 'COMPLETE')
                                ->whereDate('completed_on', '>', now()->subDays(7));
                        }
                );
                })
                ->paginate(request('paginate') ?? 5)
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

    public function store()
    {
        $attributes = array_merge($this->validateTask(), [
            'user_id' => auth()->id(),
            'status' => 'INCOMPLETE',
        ]);
        Task::create($attributes);
        return redirect('/tasks')->with('success', 'Your Task created.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    public function update(Task $task)
    {
        $status = request('status') == 1 ? 'INCOMPLETE' : 'COMPLETE';
        $attributes = array_merge(
            $this->validateTask($task), [
                'status' => $status,
                'completed_on' => $status === 'COMPLETE' ? Carbon::now() : null
            ]
        );
        $task->update($attributes);
        return redirect('/tasks')->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks')->with('success', 'Your Task deleted successfully.');
    }

    protected function validateTask(?Task $task = null): array
    {
        $task ??= new Task();
        return request()->validate([
            'title' => ['required'],
            'deadline' => ['required', 'date'],
            'description' => ['nullable'],
            'status' => $task->exists ? ['required', 'integer'] : ['nullable', 'integer']
        ]);
    }
}
