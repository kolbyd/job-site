@extends('auth.auth-layout')
@section('auth-title', 'Register')

@section('auth-form')
    <form action="{{ route('register') }}" method="POST" class="flex flex-col pt-2 px-2">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="rounded p-2 mb-2 border" required />

        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="rounded p-2 mb-2 border" required />

        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="rounded p-2 mb-2 border" required />

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="rounded p-2 mb-2 border" required />

        <button type="submit" class="bg-gray-800 cursor-pointer hover:bg-gray-900 transition-colors duration-300 my-2 text-white rounded p-2">Register</button>
    </form>
    <a href="{{ route('login') }}">
        <button class="flex bg-red-400 cursor-pointer hover:bg-red-500 transition-colors duration-300 text-white rounded p-1 w-2/3 mx-auto">
            <p class="flex mx-auto">Need to login?</p>
        </button>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            passwordConfirmation.addEventListener('input', function() {
                if (password.value !== passwordConfirmation.value) {
                    passwordConfirmation.setCustomValidity('Passwords do not match');
                } else {
                    passwordConfirmation.setCustomValidity('');
                }
            });
        });
    </script>
@endsection