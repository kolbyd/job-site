@extends('layouts.main')

{{-- This form is used for both creating and editing a job listing. It is important that we handle both cases here. --}}
@section('content')
<div class="w-full">
    <div class="flex flex-col mb-4">
        <a class="flex flex-row items-center gap-2 text-red-300 cursor-pointer" href="{{ route('listing.poster-listings') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            Back to Listings
        </a>
        <p class="text-2xl font-bold">{{ isset($listing) ? "Edit Listing" : "Create Listing" }}</p>
    </div>
    @if(isset($listing))
        {{-- TODO: Show interested users here --}}
        <div class="flex flex-col mb-4">
            <button id="interested-users-button" class="text-black bg-red-300 hover:bg-red-400 transition-colors transition-300 px-4 py-1 rounded mr-2 cursor-pointer" onclick="changeInterestedUsersDropdown()">
                Show Interested Users
            </button>
            <div id="interested-users-dropdown" class="hidden">
                @if($listing->interestedUsers->isEmpty())
                    <p class="text-gray-400">No users have shown interest in this listing.</p>
                @else
                    <ul class="list-inside text-gray-300 list-none sm:columns-2 lg:columns-4 text-center">
                        @foreach($listing->interestedUsers as $user)
                            <li><a href="mailto:{{$user->username}}" class="text-red-300 hover:text-red-400 transition-colors transition-200 cursor-pointer">{{ $user->name }}</a></li>
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

            <input type="text" name="title" id="title" value="{{ old('title', $listing->title ?? '') }}" class="p-2 rounded bg-gray-700 text-white border border-gray-400 focus:outline-none focus:ring focus:ring-red-400" required>
            @error('title')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror

            <label for="body" class="text-lg font-bold mb-2 mt-4">Body</label>
            <textarea name="body" id="body" rows="5" class="p-2 rounded bg-gray-700 text-white border border-gray-400 focus:outline-none focus:ring focus:ring-red-400" required>{{ old('body', $listing->body ?? '') }}</textarea>
            @error('body')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror

            <button type="submit" class="font-bold bg-red-400 text-black rounded px-4 py-1 mt-4 hover:bg-red-500 transition duration-300 ease-in-out cursor-pointer">
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