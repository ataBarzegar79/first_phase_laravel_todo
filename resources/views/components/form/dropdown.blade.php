@props(['name','options','nameInput'])
<x-form.dropdown-button :name="$name">
    {{ $name }}
</x-form.dropdown-button>
<div id="{{ $name }}" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="{{$name}}Button">
        @foreach($options as $option)
            <x-form.dropdown-option :name="$nameInput" :id="$option->id" :active="$name->value === $option->name">
                {{ $option->name }}
            </x-form.dropdown-option>
        @endforeach
    </ul>
</div>
<x-form.error :name="$nameInput"/>
