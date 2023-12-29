<x-master-layout>

    <div class="container mx-auto px-4 sm:px-8">

        <div class="py-8">
            <x-header-text>
                Tasks
            </x-header-text>
            <div class="flex justify-between">
                <x-form.filters/>
                <a href="/tasks/create">
                    <x-buttons.primary>Create Task</x-buttons.primary>
                </a>
            </div>

            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <x-form.head>
                                Task
                            </x-form.head>
                            <x-form.head>
                                Dead Line
                            </x-form.head>
                            <x-form.head>
                                Status
                            </x-form.head>
                            <x-form.head colspan="2">
                                Actions
                            </x-form.head>
                            <x-form.head>
                                Details
                            </x-form.head>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <x-task :task="$task"/>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="flex items-center justify-center my-5">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
