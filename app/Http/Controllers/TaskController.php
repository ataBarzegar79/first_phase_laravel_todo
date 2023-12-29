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
        //todo : why you don't have validation ?
        $task = auth()
            ->user()
            ->tasks()
            ->latest('deadline') // todo: you have copied the queries !
            ->filter(request(['search', 'select'])) // todo : don't copy!
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
        $attributes = $request->validated(); // todo: in some places you have set this name of this variable to $attribute and in the others, you are talking about Validator! , be consistent.

        $attributes['user_id'] = auth()->id();

        $task->update($attributes);

        return redirect()->route('task.index')->with('success', __('messages.update'));
    }

    public function delete(Task $task)
    {
        $task->delete(); // todo : implement a soft delete.
        return back()->with('success',  __('messages.delete'));
    }
}
