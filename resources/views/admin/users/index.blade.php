@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Header Section -->
        <div class="flex flex-wrap justify-between items-center bg-gray-800 shadow-lg rounded-lg p-6 sm:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-100">Users Management</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white py-2 px-4 sm:px-6 rounded-lg shadow hover:bg-blue-700 transition duration-300 mt-4 sm:mt-0">
                + Create New User
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <!-- Responsive Table Wrapper -->
            <div class="overflow-x-auto">
                <table class="w-full text-left table-auto border-collapse">
                    <thead class="bg-gray-700 border-b">
                        <tr>
                            <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-300">Name</th>
                            <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-300">Email</th>
                            <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-300">Role</th>
                            <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-300">Last Login IP</th>
                            <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-300">Last Login Time</th>
                            <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-300">Status</th>
                            <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-700 transition duration-300">
                                <td class="py-4 px-4 sm:px-6 text-sm text-blue-400 font-medium">
                                    <a href="/profile/{{ $user->id }}" class="hover:underline">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td class="py-4 px-4 sm:px-6 text-sm text-gray-300">{{ $user->email }}</td>
                                <td class="py-4 px-4 sm:px-6 text-sm text-gray-300">{{ $user->role->role_name ?? 'N/A' }}</td>
                                <td class="py-4 px-4 sm:px-6 text-sm text-gray-300">{{ $user->last_login_ip ?? 'N/A' }}</td>
                                <td class="py-4 px-4 sm:px-6 text-sm text-gray-300">
                                    {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'N/A' }}
                                </td>
                                <td class="py-4 px-4 sm:px-6 text-sm">
                                    @if($user->is_online)
                                        <span class="bg-green-700 text-green-100 py-1 px-3 rounded-full text-xs font-semibold">
                                            Online
                                        </span>
                                    @else
                                        <span class="bg-gray-700 text-gray-300 py-1 px-3 rounded-full text-xs font-semibold">
                                            Offline
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 sm:px-6 text-sm flex flex-wrap space-x-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-400 hover:text-blue-500">Edit</a>
                                    <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="px-6 py-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
