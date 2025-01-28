@extends('layouts.app')

@section('content')
    <div >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
