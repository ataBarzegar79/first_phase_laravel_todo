<x-master-layout>
    <div class="flex justify-center mt-10">
        <x-card class="w-full">
            <form action="/tasks" method="POST">
                @csrf
{{--                todo : very good to know that you use csrf , do you know any thing about it? , we will disscuss. --}}
                <x-form.input name="title" placeholder="Your task" required value="{{ old('title') }}" />
                <x-form.input name="deadline" type="date" required value="{{ old('deadline') }}" />
                <x-form.textarea name="description">
                    {{ old('description') }}
                </x-form.textarea>
                <x-form.submit>
                    Create Task
                </x-form.submit>
            </form>
        </x-card>
    </div>
</x-master-layout>
