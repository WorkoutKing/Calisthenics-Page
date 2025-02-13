@extends('layouts.app')

@section('content')
    <div >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <div class="bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md">
                <!-- Create Element Form -->
                <h1 class="text-xl sm:text-2xl font-bold mb-4 text-gray-200">Create New Element</h1>

                <form method="POST" action="/elements" class="mt-4 space-y-4">
                    @csrf

                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm sm:text-base font-medium text-gray-300">Name</label>
                        <input type="text" name="name" id="name" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-700 text-white">
                    </div>

                    <!-- Description Textarea -->
                    <div>
                        <label for="description" class="block text-sm sm:text-base font-medium text-gray-300">Description</label>
                        <textarea name="description" id="description" required
                                  class="mt-1 block w-full px-4 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-700 text-white"></textarea>
                    </div>

                    <!-- Exercise Dropdown -->
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
                                    {{ old('exercise_id') == $exercise->id ? 'selected' : '' }}>
                                    {{ $exercise->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm bg-indigo-600 text-white font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Create Element
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
