<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(){
        return view('task.form');
    }

    public function store(){
        $atterbutes = \request()->validate([
            'title' => 'required|max:100',
            'slug' => 'required',
            'time' => 'required|date'
        ]);
        $atterbutes['user_id'] = auth()->id();
        Task::create($atterbutes);
        return redirect('/')->with('success', 'Save Work');
    }

    public function index(Task $task)
    {
        return view('task.index',[
            'task' => $task,
            'index' => auth()->user()->task()->latest('time')->filter(request(['search']))->simplePaginate(5)
                ->withQueryString()
        ]);
    }

    public function show(Task $task){
        return view('task.show',['task' => $task]);
    }

    public function edit(Task $task){
        return view('task.edit',['task' => $task]);
    }

    public function update(Task $task){
        $atterbutes = \request()->validate([
            'title' => 'required|max:100',
            'select' => 'required',
            'slug' => 'required',
            'time' => 'required|date'
        ]);
        $atterbutes['user_id'] = auth()->id();
        $task->update($atterbutes);
        return redirect('/index')->with('success', 'update Work');
    }

    public function delete(Task $task){
        $task -> delete();
        return back()->with('success','Work delete');
    }
}
