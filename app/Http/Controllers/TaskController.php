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
        return redirect()->route('task.create')->with('success', 'Save Work'); // todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
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

    public function update(Task $task,UpdateTaskRequest $request)
    {
        $attributes = $request->validated(); // todo : you have to separate your validations in the request classes :https://laravel.com/docs/10.x/validation#main-content:~:text=Form%20Request%20Validation-,Creating%20Form%20Requests,-For%20more%20complex
        $attributes['user_id'] = auth()->id();
        $task->update($attributes);
        return redirect()->route('home')->with('success', 'update Work'); // todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
    }// todo : use translation files within your project to show a plain text: https://laravel.com/docs/10.x/localization#main-content

    public function delete(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Work delete'); // todo : use translation files within your project to show a plain text: https://laravel.com/docs/10.x/localization#main-content
    }
}
