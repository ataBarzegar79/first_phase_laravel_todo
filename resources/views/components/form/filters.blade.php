<div class="my-2 flex sm:flex-row flex-col">
    <div class="flex flex-row mb-1 sm:mb-0">
        <div class="relative">
            <form method="GET" action="/tasks/">
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if (request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <label>
                    <select
                        name="paginate"
                        onchange="this.form.submit()"
                        class="appearance-none h-full rounded-l border block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="5" {{ request('paginate') == '5' ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('paginate') == '10' ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('paginate') == '20' ? 'selected' : '' }}>20</option>
                    </select>
                </label>
            </form>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            </div>
        </div>
        <div class="relative">
            <form method="GET" action="/tasks/">
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if (request('paginate'))
                    <input type="hidden" name="paginate" value="{{ request('paginate') }}">
                @endif
                <label>
                    <select
                        name="status"
                        onchange="this.form.submit()"
                        class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                        <option value="" {{ request('status') !== \App\Enums\TaskStatus::class ? 'selected' : '' }}>All</option>
                        <option value="{{ \App\Enums\TaskStatus::Incomplete->value }}" {{ request('status') === \App\Enums\TaskStatus::Incomplete->value ? 'selected' : '' }} class="text-red-500">INCOMPLETE</option>
                        <option value="{{ \App\Enums\TaskStatus::Complete->value }}" {{ request('status') === \App\Enums\TaskStatus::Complete->value ? 'selected' : '' }} class="text-green-500">COMPLETE</option>
                    </select>
                </label>
            </form>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            </div>
        </div>
    </div>
    <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
        <form method="GET" action="/tasks/">
            @if (request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            @if (request('paginate'))
                <input type="hidden" name="paginate" value="{{ request('paginate') }}">
            @endif
                <label>
                    <input
                        type="text"
                        name="search"
                        placeholder="Find something"
                        class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                        value="{{ request('search') }}"
                    >
                </label>
        </form>
    </div>
</div>
