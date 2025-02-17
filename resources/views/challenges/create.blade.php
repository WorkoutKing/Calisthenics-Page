@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Success or Error Messages -->
            @if (session('success'))
                <div class="bg-green-800 text-green-100 p-4 rounded-lg shadow-md">
                    <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Heading -->
            <h2 class="text-3xl font-extrabold text-gray-100 text-center mb-8">Create a New Challenge</h2>

            <!-- Create Challenge Form -->
            <div class="bg-gray-800 p-8 rounded-lg shadow-lg border hover:shadow-xl transition duration-200">
                <form action="{{ route('challenges.store') }}" method="POST">
                    @csrf

                    <!-- Challenge Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-300">Challenge Name</label>
                        <input type="text" name="name" id="name" class="form-input mt-2 p-3 block w-full border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white bg-gray-700" value="{{ old('name') }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                        <textarea name="description" id="description" class="form-textarea mt-2 p-3 block w-full border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white bg-gray-700" required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Dates (Start & End) -->
                    <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-300">Start Date</label>
                            <input type="datetime-local" name="start_date" id="start_date" class="form-input mt-2 p-3 block w-full border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white bg-gray-700" value="{{ old('start_date') }}" required>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-300">End Date</label>
                            <input type="datetime-local" name="end_date" id="end_date" class="form-input mt-2 p-3 block w-full border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white bg-gray-700" value="{{ old('end_date') }}" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:bg-indigo-700 transition duration-150">
                            Create Challenge
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
