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
                ->filter(request(['search','status']))
                ->when(request('status') !== 'except', function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', '!=', 'COMPLETE') // todo : try to use local scopes as much as possible , esp when using column names.
                            ->orWhere(function ($query) {
                                $query->where('status', 'COMPLETE')
                                    ->whereDate('completed_on', '>', now()->subDays(7)); //todo : Don't use magic variables, you should get your default pagination number from configs.
                            });
                    });
                })
                ->paginate(request('paginate') ?? 5) // todo : Don't use magic variables, you should get your default pagination number from configs.
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
            'status' => 'INCOMPLETE', // todo : tend to use enums and then casting with in models:  https://laravel.com/docs/10.x/eloquent-mutators#enum-casting
        ]);
        Task::create($attributes);
        return redirect('/tasks')->with('success', 'Your Task created.');//todo: please try to always use named routes in your redirects : https://laravel.com/docs/10.x/redirects#redirecting-named-routes
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    public function update(Task $task)
    {
        $status = request('status') == 1 ? 'INCOMPLETE' : 'COMPLETE'; // todo : tend to use enums and then casting with in models:  https://laravel.com/docs/10.x/eloquent-mutators#enum-casting
        $attributes = array_merge(
            $this->validateTask($task), [
                'status' => $status,
                'completed_on' => $status === 'COMPLETE' ? Carbon::now() : null
            ]
        );
        $task->update($attributes);
        return redirect('/tasks')->with('success', 'Task updated.');//todo: please try to always use named routes in your redirects : https://laravel.com/docs/10.x/redirects#redirecting-named-routes
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks')->with('success', 'Your Task deleted successfully.'); //todo: please try to always use named routes in your redirects : https://laravel.com/docs/10.x/redirects#redirecting-named-routes
    }

    protected function validateTask(?Task $task = null): array
    {
        // todo : your way of morphing a task validation doesnt seem to be right . try to use separate request classes, your method has force you to work with possible null data and it makes your code ugly.
        $task ??= new Task(); // todo : not a true usage for a model.
        return request()->validate([
            'title' => ['required'],
            'deadline' => ['required', 'date'],
            'description' => ['nullable'],
            'status' => $task->exists ? ['required','integer'] : ['nullable','integer'] // todo: completely ugly way of coding!
        ]); // todo : you have a problem in your validation : your statuses only can be 1 or 2 and you are just checking to be integer
    }
}
