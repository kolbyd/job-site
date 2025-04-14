@extends('layouts.main')

@section('content')
<div class="w-full">
    <a class="mb-2" href="{{ route('index') }}">
        <button class="flex flex-row items-center gap-2 bg-red-500 font-bold uppercase text-white px-4 py-2 hover:bg-black transition duration-500 ease-in-out cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            Back to Listings
        </button>
    </a>
    <div class="lg:w-2/3 lg:mx-auto h-fit mt-2 mx-2 bg-red-100 p-2">
        <div class="flex flex-col md:flex-row justify-between items-center mx-2">
            <p class="text-2xl font-bold">
                {{ $listing->title }}
            </p>
            <button id="interest-status-{{ $listing->id }}-remove"
                onclick="changeInterestStatus(this, {{ $listing->id }})" 
                class="uppercase font-bold bg-red-500 hover:bg-black transition-colors transition-500 text-white px-4 py-2 mr-2 cursor-pointer {{ $listing->userInterested(auth()->user()) ? '' : 'hidden' }}">
                    Remove Interest
            </button>
            <button id="interest-status-{{ $listing->id }}-add"
                onclick="changeInterestStatus(this, {{ $listing->id }})" 
                class="uppercase font-bold border border-red-500 hover:bg-black hover:text-white transition-colors transition-500 px-4 py-[7px] mr-2 cursor-pointer {{ $listing->userInterested(auth()->user()) ? 'hidden' : '' }}">
                Show Interest
            </button>
        </div>
        <hr class="text-red-300 my-2" />
        <p class="text-gray-600 ml-2 whitespace-pre-wrap">{{ $listing->body }}</p>
        <hr class="text-red-300 my-2" />
        <div class="flex flex-col md:flex-row justify-between align-bottom mx-2">
            <p class="text-gray-500 ml-2 text-center">Posted: {{ $listing->created_at->diffForHumans() }}</p>
            <p class="text-gray-500 ml-2 text-center">Updated: {{ $listing->updated_at->diffForHumans() }}</p>
            <a class="cursor-pointer text-blue-700 hover:text-blue-900 text-center" href="mailto:{{ $listing->user->username }}?subject=Interest in {{ $listing->title }}&body=Hello {{ $listing->user->name }},%0D%0A%0D%0AI am interested in your listing titled '{{ $listing->title }}'.%0D%0A%0D%0AThank you!">
                Created by: {{ $listing->user->name }}
            </a>
        </div>
    </div>
</div>
@endsection