@extends('layouts.main')

@section('content')
<div class="w-full">
    <div class="flex flex-row items-center mb-4">
        <p class="text-2xl font-bold uppercase">User Management</p>
        <form method="GET" action="{{ route('admin.users') }}" class="flex flex-row gap-2 ml-auto">
            <input type="text" name="search" placeholder="Search by name or email" class="p-2 bg-red-100 focus:outline-none focus:ring focus:ring-red-400" value="{{ request('search') }}">
            <button type="submit" class="bg-red-500 font-bold uppercase text-white px-4 py-2 hover:bg-black transition duration-500 ease-in-out cursor-pointer">Search</button>
        </form>
    </div>
    <table class="w-full h-fit rounded border-spacing-2 border-collapse">
        <thead>
            <tr class="bg-red-500 uppercase font-bold text-white">
                <th class="text-left p-4 border border-red-800">User</th>
                <th class="text-center p-4 border border-red-800">Admin</th>
                <th class="text-center p-4 border border-red-800">Poster</th>
                <th class="text-center p-4 border border-red-800">Viewer</th>
                <th class="text-center p-4 border border-red-800">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-gray-700 accent-red-500">
                    <td class="p-2 px-4 border border-red-500">
                        {{$user->name}} ({{$user->username}})
                    </td>
                    <td class="p-2 px-4 border border-red-500 text-center">
                        <input onclick="changeRoleStatus(this,{{ $user->id }},'Admin')" type="checkbox" id="admin-{{$user->id}}" data-id="{{$user->id}}" {{ $user->hasRole(\App\Models\RoleAssignment::ADMIN_ROLE) ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 px-4 border border-red-500 text-center">
                        <input onclick="changeRoleStatus(this,{{ $user->id }},'Poster')" type="checkbox" id="poster-{{$user->id}}"data-id="{{$user->id}}" {{ $user->hasRole(\App\Models\RoleAssignment::POSTER_ROLE)  ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 px-4 border border-red-500 text-center">
                        <input onclick="changeRoleStatus(this,{{ $user->id }},'Viewer')" type="checkbox" data-id="{{$user->id}}" {{ $user->hasRole(\App\Models\RoleAssignment::VIEWER_ROLE)  ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 px-4 border border-red-500 text-center">
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer text-blue-500 hover:text-blue-900">Delete</a>
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