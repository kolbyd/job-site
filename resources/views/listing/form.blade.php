@extends('layouts.main')

{{-- This form is used for both creating and editing a job listing. It is important that we handle both cases here. --}}
@section('content')
<div class="w-full">
    <div class="flex flex-col mb-4">
        <a class="mb-2" href="{{ route('listing.poster-listings') }}">
            <button class="flex flex-row items-center gap-2 bg-red-500 font-bold uppercase text-white px-4 py-2 hover:bg-black transition duration-500 ease-in-out cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                Back to Listings
            </button>
        </a>
        <p class="text-2xl font-bold uppercase">{{ isset($listing) ? "Edit Listing" : "Create Listing" }}</p>
    </div>
    @if(isset($listing))
        <div class="flex flex-col mb-4">
            <button id="interested-users-button" class="bg-red-500 font-bold uppercase text-white px-4 py-2 hover:bg-black transition duration-500 ease-in-out cursor-pointer" onclick="changeInterestedUsersDropdown()">
                Show Interested Users
            </button>
            <div id="interested-users-dropdown" class="hidden">
                @if($listing->interestedUsers->isEmpty())
                    <p class="text-gray-500">No users have shown interest in this listing.</p>
                @else
                    <ul class="list-inside text-blue-700 list-none sm:columns-2 lg:columns-4 text-center">
                        @foreach($listing->interestedUsers as $user)
                            <li><a href="mailto:{{$user->username}}" class="hover:text-blue-900 cursor-pointer">{{ $user->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif
    <form method="POST" action="{{ isset($listing) ? route('listing.update', $listing->id) : route('listing.store') }}" class="w-full">
        @csrf
        @if (isset($listing))
            @method('PUT')
        @endif
        <div class="flex flex-col mb-4">
            <label for="title" class="text-lg font-bold mb-2">Title</label>

            <input type="text" name="title" id="title" value="{{ old('title', $listing->title ?? '') }}" class="p-2 bg-red-100 focus:outline-none focus:ring focus:ring-red-400" required>
            @error('title')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror

            <label for="body" class="text-lg font-bold mb-2 mt-4">Body</label>
            <textarea name="body" id="body" rows="5" class="p-2 bg-red-100 focus:outline-none focus:ring focus:ring-red-400" required>{{ old('body', $listing->body ?? '') }}</textarea>
            @error('body')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror

            <button type="submit" class="mt-4 bg-red-500 font-bold uppercase text-white px-4 py-2 hover:bg-black transition duration-500 ease-in-out cursor-pointer">
                Save
            </button>
        </div>
    </form>

    <script text="text/javascript">
        function changeInterestedUsersDropdown() {
            const dropdown = document.getElementById('interested-users-dropdown');
            const button = document.getElementById('interested-users-button');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');

                button.innerHTML = "Hide Interested Users";
            } else {
                dropdown.classList.add('hidden');
                button.innerHTML = "Show Interested Users";
            }
        }

    </script>
</div>
@endsection