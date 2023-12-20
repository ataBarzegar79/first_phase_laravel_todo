<!DOCTYPE html>
<html>
<head>
    <title>ToDoList</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="notbooks.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<body class="bg-blue-50">
<main>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="icon-flax">
                    <a href="{{ auth()->user() ? '/index' : '/login' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                             class="bi bi-journal-plus border-r pr-3 border-r-white mr-5 text-white" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0
                                    1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5"/>
                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1
                                    1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5
                                    0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0
                                    1h-2a.5.5 0 0 1 0-1z"/>
                        </svg>
                    </a>
                    <a href="/"><p class="text-white">ToDoList</p></a>
                </div>
                <div class="flex">
                    @auth
                        <span class="text-xs text-white font-bold uppercase">welcome, {{auth()->user()->name}}!</span>
                        <form action="/logout" method="post" class="text-xs font-semi-bold text-blue-500 ml-6">
                            @csrf
                            <button type="submit">Log Out</button>
                        </form>
                    @else
                        <div class="flex login">
                            <a href="/register"
                               class="text-xs font-bold uppercase bg-blue-500 text-white p-2 register">
                                Register
                            </a>
                            <a href="/login" class="ml-3 text-white uppercase text-xs font-bold login">
                                Log In
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    {{ $slot }}
</main>
@if(session()->has('success'))
    <div
        x-data="{show:true}"
        x-init="setTimeout(() => show = false,4000)"
        x-show="show"
        class="fixed bg-blue-500 text-white py-2 px-2 rounded-xl bottom-3 right-3 text-sm">
        {{ session()->get('success') }}
    </div>
@endif
</body>
</html>
