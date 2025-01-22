@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-xl">
        <!-- Alerts Section -->
        <div class="space-y-4 mb-6">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 rounded-lg p-4">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 rounded-lg p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg p-4">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            @if (session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 rounded-lg p-4">
                    <p>{{ session('info') }}</p>
                </div>
            @endif
        </div>

        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Post</h1>

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title Field -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}" class="block w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" required>
            </div>

            <!-- Content Field -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" rows="5" class="block w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" required>{{ $post->content }}</textarea>
            </div>

            <!-- Main Picture Field -->
            <div class="mb-6">
                <label for="main_picture" class="block text-sm font-medium text-gray-700">Main Picture</label>
                <input type="file" name="main_picture" id="main_picture" class="block w-full text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                @if ($post->main_picture)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $post->main_picture) }}" alt="Image" class="w-auto h-40 object-fit rounded-lg">
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Update Post</button>
        </form>
    </div>
@endsection
