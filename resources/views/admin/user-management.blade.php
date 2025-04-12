@extends('layouts.main')

@section('content')
<div class="w-full">
    <div class="flex flex-row">
        <p class="text-2xl font-bold mb-2">User Management</p>
        <form method="GET" action="{{ route('admin.users') }}" class="flex flex-row gap-2 mb-4 ml-auto">
            <input type="text" name="search" placeholder="Search by name or email" class="bg-gray-800 text-white rounded px-4 py-2 w-full" value="{{ request('search') }}">
            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600 transition duration-300 ease-in-out cursor-pointer">Search</button>
        </form>
    </div>
    <table class="w-full h-fit rounded border-spacing-2 border-collapse">
        <thead>
            <tr class="bg-gray-700">
                <th class="text-left p-4 border border-gray-400">User</th>
                <th class="text-center p-4 border border-gray-400">Admin</th>
                <th class="text-center p-4 border border-gray-400">Poster</th>
                <th class="text-center p-4 border border-gray-400">Viewer</th>
                <th class="text-center p-4 border border-gray-400">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-gray-400">
                    <td class="p-2 px-4 border border-gray-400">
                        {{$user->name}} ({{$user->username}})
                    </td>
                    <td class="p-2 px-4 border border-gray-400 text-center">
                        <input onclick="changeRoleStatus(this,{{ $user->id }},'Admin')" type="checkbox" id="admin-{{$user->id}}" data-id="{{$user->id}}" {{ $user->hasRole(\App\Models\RoleAssignment::ADMIN_ROLE) ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 px-4 border border-gray-400 text-center">
                        <input onclick="changeRoleStatus(this,{{ $user->id }},'Poster')" type="checkbox" id="poster-{{$user->id}}"data-id="{{$user->id}}" {{ $user->hasRole(\App\Models\RoleAssignment::POSTER_ROLE)  ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 px-4 border border-gray-400 text-center">
                        <input onclick="changeRoleStatus(this,{{ $user->id }},'Viewer')" type="checkbox" data-id="{{$user->id}}" {{ $user->hasRole(\App\Models\RoleAssignment::VIEWER_ROLE)  ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 px-4 border border-gray-400 text-center">
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer text-red-300">Delete</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mx-4 mt-4">
        {{-- Pagination links --}}
        {{ $users->links() }}
    </div>
</div>
@endsection