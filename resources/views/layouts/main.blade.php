<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>@yield('title', 'Job Site')</title>
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        <link rel="icon" href="./favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('vendor/flasher/toastr.min.css') }}">
    </head>
    <body class="flex flex-col h-screen bg-white text-black">
        <header class="flex flex-col md:flex-row md:items-center justify-between bg-red-header p-4 text-white">
            <a href="{{ route('index') }}" class="text-2xl lg:text-4xl my-auto font-bold">Job Site</a>
            <nav class="md:ml-auto">
                <ul class="flex flex-1 flex-col md:gap-6 md:flex-row md:items-center justify-around">
                    @auth
                        <li><p class="font-bold">Welcome, {{ auth()->user()->name }}</p></li>
                    @endauth
                    <li><a class="text-lg" href="{{ route('index') }}">Current Listings</a></li>
                    @role(\App\Models\RoleAssignment::POSTER_ROLE)
                        <li><a class="text-lg" href="{{ route('listing.poster-listings') }}">My Listings</a></li>
                    @endrole
                    @role(\App\Models\RoleAssignment::ADMIN_ROLE)
                        <li><a class="text-lg" href="{{ route('admin.users') }}">User Management</a></li>
                    @endrole
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
        <div class="flex flex-1 p-4">@yield('content')</div>
    </body>
</html>
