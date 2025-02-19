@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 sm:px-8">
      <div class="space-y-4">
            @if ($errors->any())
                <div class="alert alert-danger mb-6 bg-red-800 border border-red-600 text-red-300 rounded-md p-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success mb-6 bg-green-800 border border-green-600 text-green-300 rounded-md p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning mb-6 bg-yellow-800 border border-yellow-600 text-yellow-300 rounded-md p-4">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info mb-6 bg-blue-800 border border-blue-600 text-blue-300 rounded-md p-4">
                    <p>{{ session('info') }}</p>
                </div>
            @endif
        </div>
        <div class="bg-gray-800 text-white p-4 sm:p-8 rounded-lg shadow-xl">
            <h1 class="text-3xl font-semibold text-gray-100 mb-6">Create Exercise</h1>

            <form action="{{ route('admin.exercises.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-300">Title:</label>
                    <input type="text" name="title" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2" required>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-300">Description:</label>

                    <!-- Textarea for description -->
                    <textarea name="description" id="description" class="hidden">{!! old('description', isset($exercise) ? $exercise->description : '') !!}</textarea>

                    <!-- Quill editor container -->
                    <div id="editor" style="height: 500px; background: white; color: black;"></div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Initialize Quill editor
                        var quill = new Quill("#editor", {
                            theme: "snow",
                            placeholder: "Write the exercise description here...",
                        });

                        // Get the textarea and pre-fill Quill with its value
                        var descriptionTextarea = document.querySelector("#description");
                        quill.root.innerHTML = descriptionTextarea.value;

                        // Sync Quill content to the textarea whenever it changes
                        quill.on("text-change", function () {
                            descriptionTextarea.value = quill.root.innerHTML.trim();
                        });

                        // Ensure content is saved before form submission
                        document.querySelector("form").addEventListener("submit", function () {
                            descriptionTextarea.value = quill.root.innerHTML.trim();
                        });
                    });
                </script>

                <div class="mb-6">
                    <label for="primary_muscle_group_id" class="block text-sm font-medium text-gray-300">Primary Muscle Group:</label>
                    <select name="primary_muscle_group_id" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2" required>
                        @foreach ($muscleGroups as $muscleGroup)
                            <option value="{{ $muscleGroup->id }}">{{ $muscleGroup->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="secondary_muscle_groups" class="block text-sm font-medium text-gray-300">Secondary Muscle Groups:</label>
                    <select style="height:600px;" name="secondary_muscle_groups[]" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2" multiple>
                        @foreach ($muscleGroups as $muscleGroup)
                            <option value="{{ $muscleGroup->id }}">{{ $muscleGroup->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{--  <div class="mb-6">
                    <label for="main_picture" class="block text-sm font-medium text-gray-300">Main Picture (Upload on server):</label>
                    <input type="file" name="main_picture" class="block w-full px-4 py-2 border rounded-lg shadow-sm text-gray-800">
                    <small class="text-gray-500">Upload only if you are not using GIF upload!!!</small>
                </div>  --}}

                <div class="mb-6">
                    <label for="media_first_frame" class="block text-sm font-medium text-gray-300">Media URL first frame(GIF):</label>
                    <input type="url" name="media_first_frame" id="media_first_frame" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2" value="{{ old('media_first_frame', $exercise->media_first_frame ?? '') }}">
                    <small class="text-gray-500">Provide a direct URL to an first frame image of GIF.</small>
                </div>

                <div class="mb-6">
                    <label for="media_url" class="block text-sm font-medium text-gray-300">Media URL (GIF):</label>
                    <input type="url" name="media_url" id="media_url" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2" value="{{ old('media_url', $exercise->media_url ?? '') }}">
                    <small class="text-gray-500">Provide a direct URL to an GIF.</small>
                </div>

                <div class="mb-6">
                    <label for="seo_title" class="block text-sm font-medium text-gray-300">SEO Title:</label>
                    <input type="text" name="seo_title" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2">
                </div>

                <div class="mb-6">
                    <label for="seo_description" class="block text-sm font-medium text-gray-300">SEO Description:</label>
                    <textarea name="seo_description" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2"></textarea>
                </div>

                <div class="mb-6">
                    <label for="seo_keywords" class="block text-sm font-medium text-gray-300">SEO Keywords:</label>
                    <textarea name="seo_keywords" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2"></textarea>
                </div>

                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-600 transition duration-300">Create Exercise</button>
            </form>
        </div>
    </div>
@endsection

