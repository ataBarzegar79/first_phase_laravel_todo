<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 p-6 rounded-xl border bg-white">
            <div class="space-y-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title :</label>
                        <div class="mt-2">
                            <p class="block text-sm font-medium leading-6 text-gray-900">{{ $task->title }}</p>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug :</label>
                        <div class="mt-2">
                            <p class="block text-sm font-medium leading-6 text-gray-900">{{ $task->description }}</p>
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="time" class="block text-sm font-medium leading-6 text-gray-900">Time :</label>
                            <div class="mt-2">
                                <p class="block text-sm font-medium leading-6 text-gray-900">{{ $task->deadline }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
</x-layout>
