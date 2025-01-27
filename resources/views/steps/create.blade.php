@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('Add Step for Element: ') }}{{ $element->name }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-300">
                    <h1 class="text-xl sm:text-2xl font-bold mb-4">Create Step For Element: {{ $element->name }} </h1>

                    <form action="{{ route('steps.store', $element->id) }}" method="POST">
                        @csrf
                        <!-- Step Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-300">Step Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-white bg-gray-700" required>
                        </div>

                        <!-- Criteria -->
                        <div class="mb-4">
                            <label for="criteria" class="block text-sm font-medium text-gray-300">Criteria</label>
                            <textarea name="criteria" id="criteria" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-white bg-gray-700" required></textarea>
                        </div>

                        <!-- Points -->
                        <div class="mb-4">
                            <label for="points" class="block text-sm font-medium text-gray-300">Points</label>
                            <input type="number" name="points" id="points" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-white bg-gray-700" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:bg-blue-700">
                                Add Step
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
