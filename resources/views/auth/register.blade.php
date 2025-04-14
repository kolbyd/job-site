@extends('auth.auth-layout')
@section('auth-title', 'Register')

@section('auth-form')
    <form action="{{ route('register') }}" method="POST" class="flex flex-col pt-2 px-2">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="p-2 mb-2 border border-red-500" required />

        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="p-2 mb-2 border border-red-500" required />

        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="p-2 mb-2 border border-red-500" required />

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="p-2 mb-2 border border-red-500" required />

        <button type="submit" class="mb-2 bg-red-500 font-bold uppercase text-white px-4 py-2 hover:bg-black transition duration-500 ease-in-out cursor-pointer">Register</button>
    </form>
    <a href="{{ route('login') }}">
        <button class="flex uppercase font-bold border border-red-500 hover:bg-black hover:text-white transition-colors transition-500 py-[7px] w-2/3 mx-auto cursor-pointer">
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