@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Manage Posts') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Manage Posts Card Section -->
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-xl">
                <div class="flex items-center justify-between mb-6 flex-col sm:flex-row">
                    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-4 sm:mb-0">Manage Posts</h1>
                    <a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                        Create New Post
                    </a>
                </div>

                <!-- Posts Table -->
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100 text-left">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 font-semibold text-gray-700">Title</th>
                                <th class="px-4 sm:px-6 py-3 font-semibold text-gray-700">Main Picture</th>
                                <th class="px-4 sm:px-6 py-3 font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="border-b hover:bg-gray-50 transition-all">
                                    <td class="px-4 sm:px-6 py-4 text-gray-800">{{ $post->title }}</td>
                                    <td class="px-4 sm:px-6 py-4">
                                        <img src="{{ asset('storage/' . $post->main_picture) }}" alt="Image" class="w-16 sm:w-20 h-16 sm:h-20 object-cover rounded-lg">
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 text-sm text-gray-600">
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-green-500 hover:text-green-700 transition duration-200">Edit</a> |
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200" onclick="return confirm('Are you sure?')">Delete</button>
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
