<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
    public function create()
    {
        return view('task.form');
    }

    public function store()
    {
        $attributes = \request()->validate([    // todo: you don't need \ before helper methods.
            'title' => 'required|max:100',
            'task_status' => 'required',
            'description' => 'required',
            'deadline' => 'required|date'
        ]);
        $attributes['user_id'] = auth()->id();
        Task::create($attributes);
        return redirect('tasks/create')->with('success', 'Save Work'); // todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
    }

    public function index(Task $task) //todo : when we deal with multiple items , we use the index method in the controller, so as defined you should deal with a single object (here  it is task ) ,also this style of using code is known as route model binding. However, you haven't implement it in your route.
    {
//        dd(
//            auth()->user()->tasks()->latest('time')->filter(request(['search','select'])) //todo: since you aim to show list of tasks, it sound sensible to name it tasks not index.
//            ->toSql()
//        );
        return view('task.index', [
            'task' => $task, // todo : you haven't this object within your view file.
            'tasks' => auth()->user()->tasks()->latest('deadline')->filter(request(['search', 'select']))->simplePaginate(5) //todo: since you aim to show list of tasks, it sound sensible to name it tasks not index.
            ->withQueryString() //todo : For a better code view , build your query and get results, then assign final tasks in a variable, then send it into your view.
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

    public function update(Task $task)
    {
        $attributes = \request()->validate([ // todo: you don't need \ before helper methods.
            'title' => 'required|max:100',
            'task_status' => 'required',
            'description' => 'required',
            'deadline' => 'required|date'
        ]);// todo : you have to separate your validations in the request classes :https://laravel.com/docs/10.x/validation#main-content:~:text=Form%20Request%20Validation-,Creating%20Form%20Requests,-For%20more%20complex
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
