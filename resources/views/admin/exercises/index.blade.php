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
            <h1 class="text-3xl font-semibold text-gray-100 mb-6">Exercise Library</h1>

            <a href="{{ route('admin.exercises.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300 mb-4 inline-block">Add New Exercise</a>

            <!-- Search Form -->
            <form action="{{ route('admin.exercises.index') }}" method="GET" class="mb-6 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or muscle group" class="block w-full sm:w-64 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 mb-4 sm:mb-0">

                <div class="flex items-center space-x-4">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-600 transition duration-300">Search</button>

                    <!-- Clear Search Button -->
                    @if(request('search'))
                        <a href="{{ route('admin.exercises.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 transition duration-300">Clear</a>
                    @endif
                </div>
            </form>

            <!-- Exercises List -->
            <ul class="space-y-4">
                @foreach($exercises as $exercise)
                    <li class="bg-gray-700 p-4 rounded-lg shadow-sm hover:bg-gray-600 transition duration-300">
                        <div class="flex justify-between items-center">
                            <a href="{{ route('admin.exercises.show', $exercise->id) }}" class="text-xl text-white">{{ $exercise->title }}</a>
                        </div>

                        <!-- Display Primary and Secondary Muscle Groups -->
                        <div class="text-gray-400 mt-2">
                            <strong>Primary Muscle Group:</strong> {{ $exercise->primaryMuscleGroup->name ?? 'N/A' }}
                        </div>
                        <div class="text-gray-400">
                            <strong>Secondary Muscle Groups:</strong>
                            @if ($exercise->secondaryMuscleGroups->count() > 0)
                                {{ implode(', ', $exercise->secondaryMuscleGroups->pluck('name')->toArray()) }}
                            @else
                                N/A
                            @endif
                        </div>

                        <div class="space-x-4 mt-2">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.exercises.edit', $exercise->id) }}" class="text-blue-500 hover:text-blue-400">Edit</a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.exercises.destroy', $exercise->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-400">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $exercises->links() }}
            </div>
        </div>
    </div>
@endsection
