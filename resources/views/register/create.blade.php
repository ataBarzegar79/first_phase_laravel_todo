<x-master-layout>
    <div class="flex justify-center">
        <x-card class="mt-10 w-full">
            <form class="max-w-sm mx-auto" action="/register" method="POST" enctype="multipart/form-data">
                @csrf
                <x-form.input value="{{ old('name') }}" name="name" type="name" placeholder="your name" required/>
                <x-form.input value="{{ old('profile') }}" name="profile" type="file"/>
                <x-form.input value="{{ old('email') }}" name="email" type="email" placeholder="youremail@email.com" required/>
                <x-form.input name="password" type="password" placeholder="your password" required/>
                <x-form.submit>
                    Register new account
                </x-form.submit>
            </form>
        </x-card>
    </div>
</x-master-layout>
