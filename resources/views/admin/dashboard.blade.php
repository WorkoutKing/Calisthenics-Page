@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Admin Dashboard Section -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-8 text-gray-900">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">Admin Dashboard</h1>

                <!-- Cards Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Pending Challenge Results Card -->
                    <div class="group bg-blue-500 text-white p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-300">
                        <h3 class="text-2xl font-semibold mb-4">Pending Challenge Results</h3>
                        <p class="text-sm mb-6">Review the latest submissions for challenges.</p>
                        <a href="{{ route('admin.challengeResults') }}" class="bg-white text-blue-600 py-2 px-4 rounded-md font-medium shadow-md hover:bg-blue-100 transition duration-200">
                            View Details
                        </a>
                    </div>

                    <!-- Pending Element Results Card -->
                    <div class="group bg-green-500 text-white p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-300">
                        <h3 class="text-2xl font-semibold mb-4">Pending Element Results</h3>
                        <p class="text-sm mb-6">Approve or reject element submissions from users.</p>
                        <a href="{{ route('admin.elementResults') }}" class="bg-white text-green-600 py-2 px-4 rounded-md font-medium shadow-md hover:bg-green-100 transition duration-200">
                            View Details
                        </a>
                    </div>
                </div>

                <!-- Additional Links Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-8">
                    <!-- Pending Basics Results Card -->
                    <div class="group bg-yellow-500 text-white p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-300">
                        <h3 class="text-2xl font-semibold mb-4">Pending Basics Results</h3>
                        <p class="text-sm mb-6">Manage and review submissions for basic exercises.</p>
                        <a href="{{ route('admin.basicsResultsIndex') }}" class="bg-white text-yellow-600 py-2 px-4 rounded-md font-medium shadow-md hover:bg-yellow-100 transition duration-200">
                            View Details
                        </a>
                    </div>

                    <!-- Create New Challenge Card -->
                    <div class="group bg-indigo-500 text-white p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-300">
                        <h3 class="text-2xl font-semibold mb-4">Create New Challenge</h3>
                        <p class="text-sm mb-6">Start a new challenge for your users to complete.</p>
                        <a href="{{ route('challenges.create') }}" class="bg-white text-indigo-600 py-2 px-4 rounded-md font-medium shadow-md hover:bg-indigo-100 transition duration-200">
                            Create Challenge
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
