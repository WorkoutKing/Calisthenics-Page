@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 sm:px-8 py-12">
        <div class="bg-gray-800 p-8 rounded-lg shadow-xl">
            <h1 class="text-3xl font-semibold text-white mb-6">Edit Exercise</h1>

            <form action="{{ route('admin.exercises.update', $exercise->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Exercise Title -->
                <div class="mb-4">
                    <label for="title" class="block text-white">Title:</label>
                    <input type="text" name="title" value="{{ old('title', $exercise->title) }}" required class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2">
                </div>

                <!-- Exercise Description (Quill Editor) -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-300">Description:</label>

                    <!-- Textarea that will store Quill content -->
                    <textarea name="description" id="description" class="hidden">{!! old('description', $exercise->description) !!}</textarea>

                    <!-- Quill editor container -->
                    <div id="editor" style="height: 500px; background: white; color: black;"></div>
                </div>

                <!-- Primary Muscle Group -->
                <div class="mb-4">
                    <label for="primary_muscle_group_id" class="block text-white">Primary Muscle Group:</label>
                    <select name="primary_muscle_group_id" required class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2">
                        <option value="" disabled>Select Muscle Group</option>
                        @foreach($muscleGroups as $group)
                            <option value="{{ $group->id }}"
                                {{ old('primary_muscle_group_id', $exercise->primary_muscle_group_id) == $group->id ? 'selected' : '' }}>
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Secondary Muscle Groups -->
                <div class="mb-4">
                    <label for="secondary_muscle_groups" class="block text-white">Secondary Muscle Groups:</label>
                    <select name="secondary_muscle_groups[]" style="height:600px;" multiple class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2">
                        @foreach($muscleGroups as $group)
                            <option value="{{ $group->id }}"
                                {{ in_array($group->id, old('secondary_muscle_groups', $exercise->secondaryMuscleGroups->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Main Picture -->
                <div class="mb-4">
                    <label for="main_picture" class="block text-white">Main Picture:</label>
                    <input type="file" name="main_picture" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2">
                    @if($exercise->main_picture)
                        <div class="mt-2">
                            <img src="{{ Storage::disk('public')->url($exercise->main_picture) }}" alt="Exercise Image" width="150">
                        </div>
                    @endif
                </div>

                <!-- SEO Fields -->
                <div class="mb-4">
                    <label for="seo_title" class="block text-white">SEO Title:</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $exercise->seo_title) }}" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label for="seo_description" class="block text-white">SEO Description:</label>
                    <textarea name="seo_description" rows="3" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2">{{ old('seo_description', $exercise->seo_description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="seo_keywords" class="block text-white">SEO Keywords (comma separated):</label>
                    <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $exercise->seo_keywords) }}" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2">
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700">Update Exercise</button>
                </div>
            </form>

            <br>
            <a href="{{ route('admin.exercises.index') }}" class="text-blue-400 hover:text-blue-500">Back to Exercise List</a>
        </div>
    </div>
@endsection

<!-- Quill Editor Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize Quill
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
