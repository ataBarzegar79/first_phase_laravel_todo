<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All your Tasks are shown here.') }}
        </h2>
        <h3 class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('You can manage this week\'s tasks here.') }}
        </h3>
    </x-slot>

    @if(session()->has('success'))
        <div class="fixed top-0 right-0 m-4 alert-success text-white px-4 py-2 rounded shadow-lg" id="flash-message">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <style>
        /* Hide the flash message by default */
        #flash-message
        {
            display: none;
        }
        .alert-success
        {
            background-color: #1a4628;
            color: #e5e7eb;
            border: 1px solid #e5e7eb;
        }
        #flash-message {
            margin-top: 12px; /* Add 10 pixels of space above the content */
            margin-right: 12px; /* Add 10 pixels of space to the right of the content */
        }

    </style>

    <script>
        // Get the flash message element
        var flashMessage = document.getElementById("flash-message");

        // Show the flash message when the page loads
        window.onload = function() {
            flashMessage.style.display = "block";
        };

        // Hide the flash message after 10 seconds
        setTimeout(function() {
            flashMessage.style.display = "none";
        }, 10000);
    </script>

    <form action="{{ route('manage') }}" method="get" class="bg-gray-800 p-4 rounded-lg">
        <div class="flex items-center space-x-10 justify-center">

            <div class="container">
                <label for="sort" class="container2 text-gray-200">Sort by:</label>
                <select name="sort" id="sort" class="bg-gray-700 text-black border border-gray-600 rounded-md">
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Created at</option>
                    <option value="starting_time" {{ request('sort') == 'starting_time' ? 'selected' : '' }}>Starting time</option>
                    <option value="finishing_time" {{ request('sort') == 'finishing_time' ? 'selected' : '' }}>Finishing time</option>
                </select>
            </div>

            <div class="container">
                <label for="order" class="container2 text-gray-200">Order by:</label>
                <select name="order" id="order" class="bg-gray-700 text-black border border-gray-600 rounded-md space-x-10">
                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                </select>
            </div>


            <div class="container">
                <label for="filter" class="container2 text-gray-200">Filter by:</label>
                <select name="filter" id="filter" class="bg-gray-700 text-black border border-gray-600 rounded-md">
                    <option value="" {{ request('filter') == '' ? 'selected' : '' }}>All</option>
                    <option value="Done" {{ request('filter') == 'Done' ? 'selected' : '' }}>Done</option>
                    <option value="In Progress" {{ request('filter') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                </select>
            </div>


            <button type="submit" class="container bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Apply</button>

        </div>

        <style>
            .container {
                margin-left: 22px;
            }
            .container2 {
                margin-right: 7px;
            }
        </style>
    </form>


    </form>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Add a table to display the tasks -->
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2" >Title</th>
                            <th class="px-4 py-2" >Description</th>
                            <th class="px-4 py-2" >Created at</th>
                            <th class="px-4 py-2" >Starts at</th>
                            <th class="px-4 py-2" >Ends at</th>
                            <th class="px-4 py-2" >Status</th>
                            <th class="px-4 py-2" >Completed at</th>
                            <th class="px-4 py-2" >Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <!-- Loop through the tasks and display their details -->
                        @foreach ($tasks as $task)
                            @php
                                if ($task->status === 'In Progress')
                                    $completed_at = "Not Done Yet";
                                else $completed_at = $task->completed_at;
                        @endphp

                            <tr>
                                <td class="border px-4 py-2">{{ $task->title }}</td>
                                <td class="border px-4 py-2">{{ $task->body }}</td>
                                <td class="border px-4 py-2">{{ $task->created_at }}</td>
                                <td class="border px-4 py-2">{{ $task->started_at }}</td>
                                <td class="border px-4 py-2">{{ $task->ended_at }}</td>
                                <td class="border px-4 py-2">{{ $task->status }}</td>
                                <td class="border px-4 py-2">{{ $completed_at }}</td>
                                <td class="border px-4 py-2">
                                    <!-- Add some buttons to edit or delete the tasks -->
                                    <!-- Use the bg-green-500 class for the update button -->
                                    <form action="{{ route('edit', $task->slug) }}" method="GET" class="inline-block">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Update</button>
                                    </form>
                                    <!-- Use the bg-red-500 class for the delete button -->
                                    <form method="POST" action="{{ route('destroy', $task->slug) }}" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Add pagination links for the tasks -->
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
