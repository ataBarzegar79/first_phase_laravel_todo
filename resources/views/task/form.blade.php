<x-layout>
    @auth()
        <section class="px-6 py-8">
            <main class="max-w-lg mx-auto mt-10 p-6 rounded-xl border bg-blue-100">
                <form action="/form" method="post">
                    @csrf
                    <div class="space-y-12">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2
                            focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="text" name="title" id="title" autocomplete="title"
                                               class="block flex-1 border-0 py-1.5 pl-1 text-gray-900
                                   placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                               placeholder="title">
                                    </div>
                                    @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                                <div class="mt-2">
                        <textarea id="slug" name="slug" rows="3"
                                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1
                                  ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                  focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </textarea>
                                </div>
                                @error('slug')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                    <label for="time" class="block text-sm font-medium leading-6 text-gray-900">Time :</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2
                            focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="date" name="time" id="time" autocomplete="time"
                                                   class="block flex-1 border-0  py-1.5 pl-1
                                       text-gray-900 placeholder:text-gray-800 focus:ring-0 sm:text-sm sm:leading-6"
                                                   placeholder="janesmith">
                                        </div>
                                        @error('time')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="/"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">
                                    Cancel
                                </button></a>
                            <button type="submit"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                        focus-visible:outline-indigo-600">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </main>
        </section>
    @else
        <div class="home">
            ToDoList !
        </div>
    @endauth
</x-layout>
