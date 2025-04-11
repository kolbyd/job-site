<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>@yield('title', 'Job Site')</title>
        @vite('resources/css/app.css')
        <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    </head>
    <body class="bg-gray-900 text-white">
        <header class="flex flex-row items-center justify-between bg-red-400 p-4 text-black">
            <p class="text-4xl my-auto font-bold">Job Site</p>
            <nav class="w-1/3 ml-auto">
                <ul class="flex flex-1 flex-row items-center justify-around">
                    {{-- TODO: Add routing here --}}
                    <li><a href="#">Listing</a></li>
                    @auth
                        
                        <li><a href="#">Logout</a></li>
                    @endauth
                    @guest
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                    @endguest
                </ul>
            </nav>
        </header>
        <div class="container px-4 py-8">@yield('content')</div>
    </body>
</html>
