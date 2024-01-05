<!-- create-task.blade.php file -->
<div>
    <!-- Use the wire:model directive to bind the form fields to the component properties -->
    <div class="mb-4">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
        <input type="text" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="title" placeholder="Enter title">
        @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>

    <div class="mb-4">
        <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
        <input type="text" id="body" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="body" placeholder="Enter description">
        @error('body') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>

    <div class="mb-4">
        <label for="start_time" class="block text-gray-700 text-sm font-bold mb-2">Starting Time</label>
        <input type="text" id="start_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="start_time" placeholder="Enter starting time">
        @error('start_time') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>

    <div class="mb-4">
        <label for="end_time" class="block text-gray-700 text-sm font-bold mb-2">Finishing Time</label>
        <input type="text" id="end_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="end_time" placeholder="Enter finishing time">
        @error('end_time') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>

    <div class="mb-4">
        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" wire:click="createTask">Create Task</button>
    </div>
</div>
