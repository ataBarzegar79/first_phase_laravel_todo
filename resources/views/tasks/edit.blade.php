<x-master-layout>
    <div class="flex justify-center mt-10">
        <x-card class="w-full">
            <form action="/tasks/{{$task->id}}" method="POST">
                @method('PATCH')
                @csrf
                <x-form.input name="title" value="{{ old('title',$task->title) }}" placeholder="Your task" required />
                <x-form.input name="deadline" value="{{ old('deadline',\Carbon\Carbon::parse($task->deadline)->format('Y-m-d')) }}" type="date" required />
                <x-form.textarea name="description">
                    {{ old('description',$task->description) }}
                </x-form.textarea>

                <x-form.dropdown nameInput="status" :name="$task->status" :options="[(object)['name'=>'INCOMPLETE','id'=>'INCOMPLETE'],(object)['name'=>'COMPLETE','id'=>'COMPLETE']]"/>
                <br>
                <x-form.submit class="mt-5">
                    Update Task
                </x-form.submit>
            </form>
        </x-card>
    </div>
</x-master-layout>
