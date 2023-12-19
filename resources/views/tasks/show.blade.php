<x-master-layout>
    <div class="flex flex-col items-center justify-center space-y-5 mt-14">
        <x-card class="w-full space-y-5">
            <div>
                <x-form.label name="title" />
                <x-card class="bg-sky-700 text-white">
                    {{ $task->title }}
                </x-card>
            </div>
            <div>
                <x-form.label name="description" />
                <x-card class="bg-sky-700 text-white overflow-y-scroll max-h-[150px] break-words">
                    {{ $task->description ?? 'Task doesnt have any description' }}
                </x-card>
            </div>
            <div>
                <x-form.label name="status" />
                <x-card class="{{ $task->status === 'INCOMPLETE' ? 'bg-red-500' : 'bg-green-700' }} text-white">
                    {{ $task->status }}
                </x-card>
            </div>
            <div>
                <x-form.label name="deadline" />
                <x-card class="bg-sky-700 text-white">
                    {{ date_format(\Carbon\Carbon::parse($task->deadline),'Y-m-d') }}
                    <br>
                    {{ \Carbon\Carbon::parse($task->deadline)->diffForHumans() }}
                </x-card>
            </div>
            @if($task->completed_on)
                <div>
                    <x-form.label name="completed_on" />
                    <x-card class="bg-sky-700 text-white">
                        {{ date_format(\Carbon\Carbon::parse($task->completed_on),'Y-m-d') }}
                        <br>
                        {{ \Carbon\Carbon::parse($task->completed_on)->diffForHumans() }}
                    </x-card>
                </div>
            @endif
        </x-card>
        <a href="/tasks">
            <x-buttons.primary>Back</x-buttons.primary>
        </a>
    </div>
</x-master-layout>
