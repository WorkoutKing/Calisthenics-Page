@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create a New Challenge') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Display success or error messages -->
            @if (session('success'))
                <div class="mb-4 text-sm font-medium text-green-600 bg-green-100 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Create Challenge Form -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <form action="{{ route('challenges.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Challenge Name</label>
                        <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" class="form-textarea mt-1 block w-full" required></textarea>
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="datetime-local" name="start_date" id="start_date" class="form-input mt-1 block w-full" required>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="datetime-local" name="end_date" id="end_date" class="form-input mt-1 block w-full" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="mt-4 inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:bg-blue-700">Create Challenge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
