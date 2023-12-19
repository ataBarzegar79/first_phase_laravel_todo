<x-master-layout>
    <main class="flex flex-col lg:flex-row mx-5 items-center justify-center space-x-5 mt-14">
        <img class="rounded-xl" src="images/gifs/to-do-list.gif" alt="to-do list gif"/>
        <div class="flex flex-col items-center space-y-8 justify-center">
            <h1 class="text-center font-bold lg:text-7xl text-5xl max-w-3xl mt-5">
                One simple to do list for you and your team
            </h1>
            <p class="text-center lg:text-3xl text-2xl font-semibold leading-[55px] text-gray-600 max-w-[40rem]">
                Stay focused, organized, and balanced with Todolist.
                The global No. 1 among apps for to-do lists and task management.
            </p>
            @php
               if(!auth()->guest()){
                   $link = '/tasks';
               } else {
                   $link = '/register';
               }
            @endphp
            <a href="{{ $link }}" class="w-1/2">
                <x-buttons.primary class="w-full">
                    Get Started
                </x-buttons.primary>
            </a>
        </div>
    </main>
</x-master-layout>
