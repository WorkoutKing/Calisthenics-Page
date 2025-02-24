@extends('layouts.app')

@section('meta_title', 'Edit Element | Calisthenics')
@section('meta_description', 'Edit the details of an element in calisthenics.')
@section('meta_keywords', 'calisthenics, elements, edit, update')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Flash Messages -->
    @if ($errors->any())
        <div class="alert bg-red-900 border-l-4 border-red-600 text-red-100 p-4 mb-6 rounded-md">
            <strong>Oops!</strong>
            <ul class="mt-2 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert bg-green-900 border-l-4 border-green-600 text-green-100 p-4 mb-6 rounded-md">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200 mb-8">
        <h1 class="text-3xl font-bold text-center text-white mb-4">
            Edit Element: {{ $element->name }}
        </h1>

        <!-- Edit Form -->
        <form action="{{ route('elements.update', $element->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- This tells Laravel were using PUT to update the resource -->

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $element->name) }}"
                    class="block w-full px-4 py-2 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-800 text-gray-300"
                    required />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea id="description" name="description" rows="5"
                    class="block w-full px-4 py-2 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-800 text-gray-300"
                    required>{{ old('description', $element->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="exercise_id" class="block text-sm font-medium text-gray-300">
                    Associated Exercise:
                </label>
                <select name="exercise_id" id="exercise_id"
                    class="block w-full px-4 py-2 border border-gray-600 rounded-lg shadow-sm
                        focus:outline-none focus:ring-2 focus:ring-blue-500
                        bg-gray-800 text-gray-300">
                    <option value="">-- Select an Exercise (Optional) --</option>
                    @foreach ($exercises as $exercise)
                        <option value="{{ $exercise->id }}"
                            {{ (isset($element) && $element->exercise_id == $exercise->id) ? 'selected' : '' }}>
                            {{ $exercise->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="w-full py-2 px-4 rounded-md btn-extra">
                    Update Element
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
