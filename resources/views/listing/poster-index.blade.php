@extends('layouts.main')

@section('content')
<div class="w-full">
    <div class="flex flex-row">
        <div>
            <p class="text-2xl font-bold mb-2">My Listings</p>
            @role(\App\Models\RoleAssignment::ADMIN_ROLE)
            <p class="text-xs text-gray-400 mb-4">Since you are an admin, you can see all listings!</p>
            @endrole
        </div>
        <a href="{{ route('listing.create') }}" class="ml-auto justify-center h-fit my-auto">
            <button class="bg-red-400 text-black rounded px-4 py-2 hover:bg-red-500 transition duration-300 ease-in-out cursor-pointer">
                Create New Listing
            </button>
        </a>
    </div>
    <table class="w-full h-fit rounded border-spacing-2 border-collapse">
        <thead>
            <tr class="bg-gray-700">
                <th class="text-left p-4 border border-gray-400">Title</th>
                <th class="text-left p-4 border border-gray-400">Interested</th>
                <th class="text-left p-4 border border-gray-400">Created</th>
                <th class="text-center p-4 border border-gray-400">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listings as $listing)
                {{-- If the listing is older than 2 months, show that it's expired --}}
                @php
                    $expired = $listing->created_at->lt(now()->subMonths(2));
                @endphp

                <tr class="{{ $expired ? 'bg-red-200 text-black' : 'text-gray-400' }}">
                    <td class="p-2 px-4 border border-gray-400">
                        <div class="flex flex-row">
                            @if( $expired )
                                <p class="text-red-500 font-bold mr-2">EXPIRED</p>
                            @endif
                            <p>{{ $listing->title }}</p>
                        </div>
                    </td>
                    <td class="p-2 px-4 border border-gray-400">{{ $listing->interestedUsers()->count() }}</td>
                    <td class="p-2 px-4 border border-gray-400">{{ $listing->created_at->format('Y-m-d H:i') }}</td>
                    <td class="p-2 px-4 border border-gray-400">
                        <div class="flex flex-col lg:flex-row justify-around {{ $expired ? 'text-blue-700' : 'text-red-300' }}">
                            <a href="{{ route('listing.edit', $listing->id) }}" class="cursor-pointer">View/Edit</a>
                            <form method="POST" action="{{ route('listing.destroy', $listing->id) }}" class="ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cursor-pointer">Delete</a>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mx-4 mt-4">
        {{-- Pagination links --}}
        {{ $listings->links() }}
    </div>
</div>
@endsection