<x-master-layout>
    <div class="flex justify-center">
        <x-card class="mt-10 w-full">
            <form class="max-w-sm mx-auto" action="/login" method="POST">
                @csrf
                <x-form.input value="{{ old('email') }}" name="email" type="email" placeholder="youremail@email.com" required/>
                <x-form.input name="password" type="password" placeholder="your password" required/>
                <x-form.submit>
                    Login
                </x-form.submit>
            </form>
        </x-card>
    </div>
</x-master-layout>
