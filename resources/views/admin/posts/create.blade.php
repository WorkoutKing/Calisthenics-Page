@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow">
                <!-- Alerts Section -->
        <div class="space-y-4">
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
        <h1 class="text-xl font-bold mb-4">Create New Post</h1>
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="block w-full px-4 py-2 border rounded-lg" value="{{ old('title') }}" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" rows="5" class="block w-full px-4 py-2 border rounded-lg" required>{{ old('content') }}</textarea>
            </div>

            <!-- SEO Fields -->
            <div class="mb-4">
                <label for="seo_title" class="block text-sm font-medium text-gray-700">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" class="block w-full px-4 py-2 border rounded-lg" value="{{ old('seo_title') }}">
            </div>

            <div class="mb-4">
                <label for="seo_description" class="block text-sm font-medium text-gray-700">SEO Description</label>
                <textarea name="seo_description" id="seo_description" rows="3" class="block w-full px-4 py-2 border rounded-lg">{{ old('seo_description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="seo_keywords" class="block text-sm font-medium text-gray-700">SEO Keywords</label>
                <input type="text" name="seo_keywords" id="seo_keywords" class="block w-full px-4 py-2 border rounded-lg" value="{{ old('seo_keywords') }}">
            </div>

            <div class="mb-4">
                <label for="main_picture" class="block text-sm font-medium text-gray-700">Main Picture</label>
                <input type="file" name="main_picture" id="main_picture" class="block w-full text-sm">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Create Post</button>
        </form>
    </div>
@endsection
