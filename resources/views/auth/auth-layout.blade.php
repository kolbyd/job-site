@extends('layouts.main')

@section('content')
    <div class="flex flex-col m-auto w-full sm:w-2/3 lg:w-5/16 rounded p-2 bg-red-300 text-black">
        <p class="text-2xl mx-auto font-bold my-2">@yield('auth-title')</p>
        @yield('auth-form')
    </div>
@endsection