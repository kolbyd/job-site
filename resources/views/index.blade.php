@extends('layouts.main')

@section('content')
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-6 mx-2 mt-2">
            @foreach ($listings as $listing)
                <div class="flex flex-col bg-red-100 p-4 shadow-md">
                    <h2 class="text-xl font-bold mb-2">{{ $listing->title }}</h2>
                    <p class="text-gray-500 mb-2 line-clamp-5 whitespace-pre-wrap">{{ $listing->body }}</p>
                    <div class="flex xl:flex-1 flex-col xl:flex-row items-center xl:items-end gap-2 xl:gap-0 xl:justify-between mt-auto">
                        <p class="text-gray-500">{{ $listing->created_at->diffForHumans() }}</p>
                        <div class="overflow-hidden flex flex-col sm:flex-row items-center gap-2 xl:gap-0">
                            @role(\App\Models\RoleAssignment::VIEWER_ROLE)
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
                            @endrole
                            <a href="{{ route('listing', $listing->id) }}">
                                <button class="group bg-red-500 text-white px-4 py-2 hover:bg-black transition-colors transition-500 cursor-pointer uppercase font-bold">
                                    <div class="flex flex-row gap-2 items-center">
                                        View Full Listing
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="size-6 bg-red-700 py-1 group-hover:bg-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                        </svg>
                                    </div>    
                                </button>
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