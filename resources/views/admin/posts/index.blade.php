@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-100 leading-tight">
        {{ __('Manage Posts') }}
    </h2>
@endsection

@section('content')
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Manage Posts Card Section -->
            <div class="bg-gray-800 p-6 sm:p-8 rounded-lg shadow-xl">
                <div class="flex items-center justify-between mb-6 flex-col sm:flex-row">
                    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-100 mb-4 sm:mb-0">Manage Posts</h1>
                    <a href="{{ route('admin.posts.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                        Create New Post
                    </a>
                </div>

                <!-- Posts Table -->
                <div class="overflow-x-auto bg-gray-800 shadow-md rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-700 text-left text-gray-300">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 font-semibold">Title</th>
                                <th class="px-4 sm:px-6 py-3 font-semibold">Main Picture</th>
                                <th class="px-4 sm:px-6 py-3 font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="border-b border-gray-700 hover:bg-gray-700 transition-all">
                                    <td class="px-4 sm:px-6 py-4 text-gray-300">{{ $post->title }}</td>
                                    <td class="px-4 sm:px-6 py-4">
                                        <img src="{{ asset('storage/' . $post->main_picture) }}" alt="Image" class="w-16 sm:w-20 h-16 sm:h-20 object-cover rounded-lg">
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 text-sm text-gray-400">
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-green-400 hover:text-green-500 transition duration-200">Edit</a> |
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-500 transition duration-200" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
