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
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-xl">
            <h1 class="text-3xl font-semibold text-gray-100 mb-6">Create Exercise</h1>

            <form action="{{ route('admin.exercises.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-300">Title:</label>
                    <input type="text" name="title" class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800" required>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-300">Description:</label>
                    <textarea name="description" style="height:500px;" class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800" required></textarea>
                </div>

                <div class="mb-6">
                    <label for="primary_muscle_group_id" class="block text-sm font-medium text-gray-300">Primary Muscle Group:</label>
                    <select name="primary_muscle_group_id" class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800" required>
                        @foreach ($muscleGroups as $muscleGroup)
                            <option value="{{ $muscleGroup->id }}">{{ $muscleGroup->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="secondary_muscle_groups" class="block text-sm font-medium text-gray-300">Secondary Muscle Groups:</label>
                    <select style="height:600px;" name="secondary_muscle_groups[]" class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800" multiple>
                        @foreach ($muscleGroups as $muscleGroup)
                            <option value="{{ $muscleGroup->id }}">{{ $muscleGroup->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="main_picture" class="block text-sm font-medium text-gray-300">Main Picture:</label>
                    <input type="file" name="main_picture" class="block w-full px-4 py-2 border rounded-lg shadow-sm text-gray-800">
                </div>

                <div class="mb-6">
                    <label for="seo_title" class="block text-sm font-medium text-gray-300">SEO Title:</label>
                    <input type="text" name="seo_title" class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                </div>

                <div class="mb-6">
                    <label for="seo_description" class="block text-sm font-medium text-gray-300">SEO Description:</label>
                    <textarea name="seo_description" class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800"></textarea>
                </div>

                <div class="mb-6">
                    <label for="seo_keywords" class="block text-sm font-medium text-gray-300">SEO Keywords:</label>
                    <textarea name="seo_keywords" class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800"></textarea>
                </div>

                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-600 transition duration-300">Create Exercise</button>
            </form>
        </div>
    </div>
@endsection

<script>
    tinymce.init({
        selector: 'textarea[name="description"]',  // Target the textarea by name
        height: 500,  // Set the height of the editor
        plugins: 'advlist autolink lists link image charmap print preview anchor',  // Add useful plugins
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',  // Customize the toolbar
        menubar: false,  // Optionally disable the menu bar
        content_style: "body { font-family:Arial, sans-serif; font-size:14px; }"  // Optional: Set the font style
    });
</script>
