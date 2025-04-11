@extends('auth.auth-layout')
@section('auth-title', 'Login')

@section('auth-form')
    <form action="{{ route('login') }}" method="POST" class="flex flex-col pt-2 px-2">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="rounded p-2 mb-2 border" required />

        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="rounded p-2 mb-2 border" required />

        <button type="submit" class="bg-gray-800 cursor-pointer hover:bg-gray-900 transition-colors duration-300 my-2 text-white rounded p-2">Login</button>
    </form>
    <a href="{{ route('register') }}">
        <button class="flex bg-red-400 cursor-pointer hover:bg-red-500 transition-colors duration-300 text-white rounded p-1 w-2/3 mx-auto">
            <p class="flex mx-auto">Need to register?</p>
        </button>
    </a>
@endsection