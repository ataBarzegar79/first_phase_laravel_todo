<x-master-layout>
    <div class="flex justify-center mt-10">
        <x-card class="w-full">
            <form action="/tasks" method="POST">
                @csrf
                <x-form.input name="title" placeholder="Your task" required value="{{ old('title') }}" />
                <x-form.input name="deadline" type="date" required value="{{ old('deadline') }}" />
                <x-form.textarea name="description" value="{{ old('description') }}" />
                <x-form.submit>
                    Create Task
                </x-form.submit>
            </form>
        </x-card>
    </div>
</x-master-layout>
