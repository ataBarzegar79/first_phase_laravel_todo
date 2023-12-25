<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function create()
    {
        return view('task.form');
    }

    public function store(StoreTaskRequest $request)
    {
        $attributes = $request->validated();

        $attributes['user_id'] = auth()->id();

        Task::create($attributes);

        return redirect()->route('task.create')->with('success', __('message.save'));
    }

    public function index()
    {
        $task = auth()
            ->user()
            ->tasks()
            ->latest('deadline')
            ->filter(request(['search', 'select']))
            ->simplePaginate(5)
            ->withQueryString();

        return view('task.index', [
            'tasks' => $task
        ]);
    }

    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    public function edit(Task $task)
    {
        return view('task.edit', ['task' => $task]);
    }

    public function update(Task $task, UpdateTaskRequest $request)
    {
        $attributes = $request->validated();

        $attributes['user_id'] = auth()->id();

        $task->update($attributes);

        return redirect()->route('task.index')->with('success', __('messages.update'));
    }

    public function delete(Task $task)
    {
        $task->delete();

        return back()->with('success',  __('messages.delete'));
    }
}
