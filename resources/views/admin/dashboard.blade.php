@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Admin Dashboard Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-semibold mb-6">Admin Dashboard</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Pending Challenge Results Section -->
                    <div class="bg-blue-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-medium text-gray-800 mb-4">Pending Challenge Results</h3>
                        <a href="{{ route('admin.challengeResults') }}" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                            View Pending Challenge Results
                        </a>
                    </div>

                    <!-- Pending Element Results Section -->
                    <div class="bg-green-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-medium text-gray-800 mb-4">Pending Element Results</h3>
                        <a href="{{ route('admin.elementResults') }}" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                            View Pending Element Results
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection