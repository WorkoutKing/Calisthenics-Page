@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-8">
            <h1 class="text-2xl font-bold mb-4">Users Management</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md mb-4 inline-block">Create New User</a>
            <table class="w-full border-collapse bg-white">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Role</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->role->role_name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600">Edit</a>
                                <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
