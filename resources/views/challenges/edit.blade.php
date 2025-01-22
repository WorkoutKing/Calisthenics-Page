@extends('layouts.app')

@section('meta_title', 'Edit Challenge | Calisthenics')
@section('meta_description', 'Edit the challenge details, such as name, description, and dates.')
@section('meta_keywords', 'calisthenics, challenges, edit, name, description, dates')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Success or Error Messages -->
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow-md">
                    <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Edit Challenge Form -->
            <div class="bg-white p-8 rounded-lg shadow-lg border hover:shadow-xl transition duration-200">
                <form action="{{ route('challenges.update', $challenge->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Challenge Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Challenge Name</label>
                        <input type="text" name="name" id="name" class="form-input mt-2 p-3 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('name', $challenge->name) }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" class="form-textarea mt-2 p-3 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('description', $challenge->description) }}</textarea>
                    </div>

                    <!-- Dates (Start & End) -->
                    <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="datetime-local" name="start_date" id="start_date" class="form-input mt-2 p-3 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('start_date', \Carbon\Carbon::parse($challenge->start_date)->format('Y-m-d\TH:i')) }}" required>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="datetime-local" name="end_date" id="end_date" class="form-input mt-2 p-3 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('end_date', \Carbon\Carbon::parse($challenge->end_date)->format('Y-m-d\TH:i')) }}" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:bg-blue-700 transition duration-150">
                            Update Challenge
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
