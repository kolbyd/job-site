<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>@yield('title', 'Job Site')</title>
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        <link rel="icon" href="./favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher.min.css') }}">
    </head>
    <body class="flex flex-col h-screen bg-gray-900 text-white">
        <header class="flex flex-row items-center justify-between bg-red-400 p-4 text-black">
            <a href="{{ route('index') }}" class="text-2xl lg:text-4xl my-auto font-bold">Job Site</a>
            <nav class="w-1/3 ml-auto">
                <ul class="flex flex-1 flex-row items-center justify-around">
                    {{-- TODO: Add routing here --}}
                    <li><a class="text-lg" href="{{ route('index') }}">Listing</a></li>
                    @auth
                        <li><a class="text-lg" href="{{ route('logout') }}">Logout</a></li>
                    @endauth
                    @guest
                        <li><a class="text-lg" href="{{ route('login') }}">Login</a></li>
                        <li><a class="text-lg" href="{{ route('register') }}">Register</a></li>
                    @endguest
                </ul>
            </nav>
        </header>
        <div class="flex flex-1 px-4 py-8">@yield('content')</div>
    </body>
</html>
