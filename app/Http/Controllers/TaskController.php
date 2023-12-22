<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request; //todo : avoid unused import in your project !

//todo: your code isn't in the right format ----->  ctrl + alt + l

class TaskController extends Controller
{
    public function create(){
        return view('task.form');
    }

    public function store(){
        $atterbutes = \request()->validate([    // todo: you don't need \ before helper methods.
            'title' => 'required|max:100', // todo: try to use your attribute in the right spelled way : $atterbutes ---> $attributes
            'select' => 'required',
            'slug' => 'required',
            'time' => 'required|date'
        ]);
        $atterbutes['user_id'] = auth()->id(); // todo: try to use your attribute in the right spelled way : $atterbutes ---> $attributes
        Task::create($atterbutes);
        return redirect('/')->with('success', 'Save Work'); // todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
    }

    public function index(Task $task) //todo : when we deal with multiple items , we use the index method in the controller, so as defined you should deal with a single object (here  it is task ) ,also this style of using code is known as route model binding. However, you haven't implement it in your route.
    {
        dd(
            auth()->user()->tasks()->latest('time')->filter(request(['search','select'])) //todo: since you aim to show list of tasks, it sound sensible to name it tasks not index.
            ->toSql()
        );
        return view('task.index',[
            'task' => $task, // todo : you haven't this object within your view file.
            'index' => auth()->user()->tasks()->latest('time')->filter(request(['search','select']))->simplePaginate(5) //todo: since you aim to show list of tasks, it sound sensible to name it tasks not index.
                ->withQueryString() //todo : For a better code view , build your query and get results, then assign final tasks in a variable, then send it into your view.
        ]);
    }

    public function show(Task $task){
        return view('task.show',['task' => $task]);
    }

    public function edit(Task $task){
        return view('task.edit',['task' => $task]);
    }

    public function update(Task $task){
        $atterbutes = \request()->validate([ // todo: you don't need \ before helper methods.
            'title' => 'required|max:100',
            'select' => 'required',
            'slug' => 'required',
            'time' => 'required|date'
        ]);// todo : you have to separate your validations in the request classes :https://laravel.com/docs/10.x/validation#main-content:~:text=Form%20Request%20Validation-,Creating%20Form%20Requests,-For%20more%20complex
        $atterbutes['user_id'] = auth()->id(); // todo: try to use your attribute in the right spelled way : $atterbutes ---> $attributes
        $task->update($atterbutes);
        return redirect('/index')->with('success', 'update Work'); // todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
    }// todo : use translation files within your project to show a plain text: https://laravel.com/docs/10.x/localization#main-content

    public function delete(Task $task){
        $task -> delete();
        return back()->with('success','Work delete'); // todo : use translation files within your project to show a plain text: https://laravel.com/docs/10.x/localization#main-content
    }
}
