@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold text-white mb-6">Create New Release</h1>

                <form method="POST" action="{{ route('releases.store') }}">
                    @csrf

                    <!-- Title Field -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="block w-full px-4 py-2 border rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" required>
                    </div>

                    <!-- Release Date Field -->
                    <div class="mb-6">
                        <label for="release_date" class="block text-sm font-medium text-gray-300">Release Date</label>
                        <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}" class="block w-full px-4 py-2 border rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" required>
                    </div>

                    <!-- Description Field -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300">Description</label>

                        <!-- Hidden Textarea for Quill -->
                        <textarea name="description" id="description" class="hidden">{!! old('description') !!}</textarea>

                        <!-- Quill editor container -->
                        <div id="editor" class="bg-white text-black rounded-lg" style="height: 300px;"></div>
                    </div>

                    <!-- Image URL Field -->
                    <div class="mb-6">
                        <label for="image_url" class="block text-sm font-medium text-gray-300">Image URL</label>
                        <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" class="block w-full px-4 py-2 border rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    </div>

                    <!-- Create Button -->
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition duration-300 w-full sm:w-auto">
                        Create Release
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var quill = new Quill("#editor", {
            theme: "snow",
            placeholder: "Write the release description here...",
        });

        var descriptionTextarea = document.querySelector("#description");
        quill.root.innerHTML = descriptionTextarea.value;

        quill.on("text-change", function () {
            descriptionTextarea.value = quill.root.innerHTML.trim();
        });

        document.querySelector("form").addEventListener("submit", function () {
            descriptionTextarea.value = quill.root.innerHTML.trim();
        });
    });
</script>
