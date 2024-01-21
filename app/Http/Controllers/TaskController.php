<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function create()
    {
        return view('/dashboard'); //todo use route names
    }

    public function store(StoreTaskRequest $request)
    {
        $validator = $request->validated();
        // todo : you also had access to title like this :
        // $request->title
        $validator['user_id'] = auth()->id();

        Task::create($validator);

        return redirect()->route('dashboard')->with('success', __('messages.save'));
    }

    public function index(IndexTaskRequest $request)
    {
        $validator = $request->validated();
        //todo : your validator is always an empty array !!!!!!

        $task = auth()
            ->user()
            ->tasks()
            ->latest('deadline')
            ->filter() // todo: it is not right to make it scope.
            ->select($validator) //todo : you haven't chosen a good name . select is a very specific name in Sql. change it.
            ->search($validator) // todo : put search out of scope.
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
        $validator = $request->validated();

        $validator['user_id'] = auth()->id(); //todo : why do you update user_id ?

        $task->update($validator);

        return redirect()->route('task.index')->with('success', __('messages.update'));
    }

    public function delete(Task $task)
    {
        $task->delete();
        return back()->with('success',  __('messages.delete'));
    }
}
