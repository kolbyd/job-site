@extends('layouts.main')

@section('content')
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-8 mx-2">
            @foreach ($listings as $listing)
                <div class="flex flex-col bg-gray-800 p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-2">{{ $listing->title }}</h2>
                    <p class="text-gray-300 mb-2 line-clamp-5 whitespace-pre-wrap">{{ $listing->body }}</p>
                    <div class="flex xl:flex-1 flex-col xl:flex-row items-center xl:items-end gap-2 xl:gap-0 xl:justify-between mt-auto">
                        <p class="text-gray-400">Posted: {{ $listing->created_at->diffForHumans() }}</p>
                        <div class="overflow-hidden flex flex-col sm:flex-row items-center gap-2 xl:gap-0">
                            @role(\App\Models\RoleAssignment::VIEWER_ROLE)
                                <button id="interest-status-{{ $listing->id }}-remove"
                                    onclick="changeInterestStatus(this, {{ $listing->id }})" 
                                    class="bg-blue-700 hover:bg-blue-800 transition-colors transition-300 text-white px-4 py-1 rounded mr-2 cursor-pointer {{ $listing->userInterested(auth()->user()) ? '' : 'hidden' }}">
                                        Remove Interest
                                </button>
                                <button id="interest-status-{{ $listing->id }}-add"
                                    onclick="changeInterestStatus(this, {{ $listing->id }})" 
                                    class="border border-blue-400 hover:bg-gray-700 transition-colors transition-300 text-white px-4 py-1 rounded mr-2 cursor-pointer {{ $listing->userInterested(auth()->user()) ? 'hidden' : '' }}">
                                    Show Interest
                                </button>
                            @endrole
                            <a href="{{ route('listing', $listing->id) }}">
                                <button class="bg-red-300 text-black px-4 py-1 rounded hover:bg-red-400 transition-colors transition-300 cursor-pointer">View Full Listing</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    
        <div class="mx-4 mt-4">
            {{-- Pagination links --}}
            {{ $listings->links() }}
        </div>
    </div>
@endsection