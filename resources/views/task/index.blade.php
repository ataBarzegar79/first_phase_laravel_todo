<x-layout>
    <section class="px-6 py-12">
        <main class="w-full mx-auto mt-10 p-6 rounded-xl border bg-white">
            <div>
                <div class="flex">
                    <form action="#" method="GET">
                        <input type="text" name="search" class="bg-gray-200 placeholder-black font-semi-bold p-2 text-sm mb-3"
                               placeholder="search" value="{{request('search')}}">
                    </form>
                    <form action="#" method="get" onchange="this.form.submit()">
                        <label for="select" class="block text-sm font-medium leading-6 text-gray-900"></label>
                        <input type="text" name="select" class="ml-4 bg-gray-200 placeholder-black font-semi-bold p-2 text-sm mb-3"
                               placeholder="Completed or NotCompleted" value="{{request('select')}}">
                    </form>
                </div>
            </div>
            <table class="table-fixed border w-full">
                <thead>
                <tr>
                    <th class="title">Title</th>
                    <th>Completed</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($index as $task)
                    @if(auth()->user()->id == $task->user_id)
                        <tr class="border w-full">
                            <td class="title">
                                <a href="/show/{{$task->id}}" class="ml-2">
                                    {{ $task->title }}
                                </a>
                            </td>
                            <td class="pr-11">
                                <a>{{$task->select}}</a>
                            </td>
                            <td class="pr-11 text-blue-700"><a href="/edit/{{ $task->id }}">update</a></td>
                            <td class="pr-8 text-red-700">
                                <form action="/delete/{{ $task->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>delete</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <p class="mt-3">
                {{ $index->links() }}
            </p>
        </main>
    </section>
</x-layout>
