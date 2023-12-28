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
        //todo: why you haven't defined validation for this method?
        $tasks = auth()->user()->tasks();
        $requestedTaskStatus = request('status');
        switch ($requestedTaskStatus) {
            case 'complete': // todo: compare usages of enums.
                $tasks = $tasks->complete();
                break;
            case TaskStatus::Incomplete->value:
                $tasks = $tasks->incomplete();
                break;
            default:
                $tasks = $tasks->where(function (Builder $query) {
                    $query->complete()->orWhere(function (Builder $query) {
                        $query->incomplete();
                    });
                });
        }

        $searchableItem = request('search');
        if ($searchableItem !== null) {
            $tasks->where(function (Builder $query) use ($searchableItem) {
                $query->titleHas($searchableItem)->orWhere(function (Builder $query) use ($searchableItem) {
                    $query->descriptionHas($searchableItem);
                }
                );
            });
        }

        $tasks = $tasks->latest('deadline'); // todo: can be done with he help of scopes.

        // todo: check the sql code of my code to see if it fits your need in logic or not ? I'm not sure about it.
        return view('tasks.index', [
            'tasks' => $tasks->paginate(request('paginate') ?? Config::get('view.paginate'))
                ->withQueryString()
        ]);

//        auth()->user()->tasks()
//            ->latest('deadline')
//            ->filter(request(['search', 'status']))
//            ->incomplete()
//            ->orWhere(function (Builder $query) {
//                $query->complete()
//                    ->whereDate('completed_on', '>', now()->subDays(Config::get('view.completeDay')));
//            })
//            ->paginate(request('paginate') ?? Config::get('view.paginate'))
//            ->withQueryString()
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
                'completed_on' => request('status') === TaskStatus::Complete ? Carbon::now() : null
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
