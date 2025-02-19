@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-6 sm:p-8 rounded-lg shadow-xl">
                <!-- Alerts Section -->
                <div class="space-y-4 mb-6">
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

                <h1 class="text-2xl font-semibold text-white mb-6">Edit Post</h1>

                <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                        <input type="text" name="title" id="title" value="{{ $post->title }}" class="block w-full px-4 py-3 border rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" required>
                    </div>

                    <!-- Content Field with Quill Editor -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-300">Content</label>

                        <!-- Hidden Textarea for form submission -->
                        <textarea name="content" id="content" class="hidden">{!! old('content', $post->content) !!}</textarea>

                        <!-- Quill editor container -->
                        <div id="editor" style="height: 500px; background: white; color: black;"></div>
                    </div>

                    <!-- Quill Editor Script -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var quill = new Quill("#editor", {
                                theme: "snow",
                                placeholder: "Write the post content here...",
                            });

                            var contentTextarea = document.querySelector("#content");
                            quill.root.innerHTML = contentTextarea.value;

                            quill.on("text-change", function () {
                                contentTextarea.value = quill.root.innerHTML.trim();
                            });

                            document.querySelector("form").addEventListener("submit", function () {
                                contentTextarea.value = quill.root.innerHTML.trim();
                            });
                        });
                    </script>

                    <!-- Main Picture Field -->
                    <div class="mb-6">
                        <label for="main_picture" class="block text-sm font-medium text-gray-300">Main Picture</label>
                        <input type="file" name="main_picture" id="main_picture" class="block w-full text-sm border rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                        @if ($post->main_picture)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $post->main_picture) }}" alt="Image" class="w-auto h-40 object-cover rounded-lg">
                            </div>
                        @endif
                    </div>

                    <!-- SEO Fields -->
                    <div class="mb-4">
                        <label for="seo_title" class="block text-sm font-medium text-gray-300">SEO Title</label>
                        <input type="text" name="seo_title" id="seo_title" class="block w-full px-4 py-2 border rounded-lg text-white bg-gray-700" value="{{ $post->seo_title }}">
                    </div>

                    <div class="mb-4">
                        <label for="seo_description" class="block text-sm font-medium text-gray-300">SEO Description</label>
                        <textarea name="seo_description" id="seo_description" rows="3" class="block w-full px-4 py-2 border rounded-lg text-white bg-gray-700">{{ $post->seo_description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="seo_keywords" class="block text-sm font-medium text-gray-300">SEO Keywords</label>
                        <input type="text" name="seo_keywords" id="seo_keywords" class="block w-full px-4 py-2 border rounded-lg text-white bg-gray-700" value="{{ $post->seo_keywords }}">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Update Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
