@extends('layouts.main')

@section('content')
    <div class="flex flex-col m-auto w-full sm:w-2/3 lg:w-5/16 p-2 bg-red-100 text-black">
        <p class="text-2xl mx-auto font-bold my-2 uppercase">@yield('auth-title')</p>
        @yield('auth-form')
    </div>
@endsection