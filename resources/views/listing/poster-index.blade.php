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
        <a href="#" class="ml-auto justify-center h-fit my-auto">
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
                <tr>
                    <td class="p-2 px-4 border border-gray-400 text-gray-400">{{ $listing->title }}</td>
                    <td class="p-2 px-4 border border-gray-400 text-gray-400">{{ $listing->interestedUsers()->count() }}</td>
                    <td class="p-2 px-4 border border-gray-400 text-gray-400">{{ $listing->created_at->format('Y-m-d H:i') }}</td>
                    <td class="p-2 px-4 border border-gray-400 text-gray-400">
                        <div class="flex flex-col lg:flex-row justify-around">
                            <a class="text-red-300 cursor-pointer">View/Edit</a>
                            <a class="text-red-300 cursor-pointer">Delete</a>
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