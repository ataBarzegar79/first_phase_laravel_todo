@props(['task'])
@php
    switch ($task->status):
        case \App\Enums\TaskStatus::Complete:
            $colorStatus = 'bg-green-400';
            break;
        case \App\Enums\TaskStatus::Incomplete:
            $colorStatus = 'bg-red-400';
            break;
    endswitch;
@endphp
<tr>
    <x-table.row>
        <div class="flex items-center justify-center space-x-4">
            <a class="text-blue-700" href="/tasks/{{ $task->id }}">
                <p class=" whitespace-no-wrap">{{ $task->title }}</p>
            </a>
        </div>
    </x-table.row>
    <x-table.row>
        <p class="text-gray-900 whitespace-no-wrap">
            <time>{{ date_format(\Carbon\Carbon::parse($task->deadline),'Y-m-d') }}</time>
        </p>
    </x-table.row>
    <x-table.row>
        <span
            class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
            <span
                class="absolute inset-0 {{ $colorStatus }} opacity-50 rounded-full"></span>
            <span class="relative">{{ $task->status }}</span>
        </span>
    </x-table.row>
    <x-table.row>
        <a href="/tasks/{{$task->id}}/edit" class="text-blue-400 hover:text-blue-600">Edit</a>
    </x-table.row>
    <x-table.row>
        <a
            href="#"
            class="text-red-400 hover:text-red-600"
            x-data="{}"
            @click.prevent="document.querySelector('#delete-{{$task->id}}').submit()"
        >
            Delete
        </a>
        <form id="delete-{{$task->id}}" action="/tasks/{{$task->id}}" method="POST" class="hidden">
            @method('DELETE')
            @csrf
        </form>
    </x-table.row>
    <x-table.row>
        <a href="/tasks/{{ $task->id }}" class="text-sky-600 hover:text-sky-700">More</a>
    </x-table.row>
</tr>
