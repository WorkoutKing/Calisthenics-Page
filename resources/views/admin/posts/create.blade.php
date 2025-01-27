@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <!-- Alerts Section -->
                <div class="space-y-4">
                    @if ($errors->any())
                        <div class="bg-red-700 border border-red-600 text-red-100 rounded-lg p-4">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-700 border border-green-600 text-green-100 rounded-lg p-4">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="bg-yellow-700 border border-yellow-600 text-yellow-100 rounded-lg p-4">
                            <p>{{ session('warning') }}</p>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="bg-blue-700 border border-blue-600 text-blue-100 rounded-lg p-4">
                            <p>{{ session('info') }}</p>
                        </div>
                    @endif
                </div>

                <h1 class="text-2xl font-bold text-white mb-4">Create New Post</h1>
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                        <input type="text" name="title" id="title" class="block w-full px-4 py-2 border rounded-lg text-white bg-gray-700" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-300">Content</label>
                        <textarea name="content" id="content" rows="5" class="block w-full px-4 py-2 border rounded-lg text-white bg-gray-700" required>{{ old('content') }}</textarea>
                    </div>

                    <!-- SEO Fields -->
                    <div class="mb-4">
                        <label for="seo_title" class="block text-sm font-medium text-gray-300">SEO Title</label>
                        <input type="text" name="seo_title" id="seo_title" class="block w-full px-4 py-2 border rounded-lg text-white bg-gray-700" value="{{ old('seo_title') }}">
                    </div>

                    <div class="mb-4">
                        <label for="seo_description" class="block text-sm font-medium text-gray-300">SEO Description</label>
                        <textarea name="seo_description" id="seo_description" rows="3" class="block w-full px-4 py-2 border rounded-lg text-white bg-gray-700">{{ old('seo_description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="seo_keywords" class="block text-sm font-medium text-gray-300">SEO Keywords</label>
                        <input type="text" name="seo_keywords" id="seo_keywords" class="block w-full px-4 py-2 border rounded-lg text-white bg-gray-700" value="{{ old('seo_keywords') }}">
                    </div>

                    <div class="mb-4">
                        <label for="main_picture" class="block text-sm font-medium text-gray-300">Main Picture</label>
                        <input type="file" name="main_picture" id="main_picture" class="block w-full text-sm text-gray-300 bg-gray-700 border rounded-lg">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Create Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
