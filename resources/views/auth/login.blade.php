@extends('auth.auth-layout')
@section('auth-title', 'Login')

@section('auth-form')
    <form action="{{ route('login.post') }}" method="POST" class="flex flex-col pt-2 px-2">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="p-2 mb-2 border border-red-500" required />

        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="p-2 mb-2 border border-red-500" required />

        <button type="submit" class="mb-2 bg-red-500 font-bold uppercase text-white px-4 py-2 hover:bg-black transition duration-500 ease-in-out cursor-pointer">Login</button>
    </form>
    <a href="{{ route('register') }}">
        <button class="flex uppercase font-bold border border-red-500 hover:bg-black hover:text-white transition-colors transition-500 py-[7px] w-2/3 mx-auto cursor-pointer">
            <p class="flex mx-auto">Need to register?</p>
        </button>
    </a>
@endsection