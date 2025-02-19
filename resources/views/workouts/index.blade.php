@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
       <div class="space-y-4">
            @if ($errors->any())
                <div class="bg-red-700 border border-red-600 text-red-100 rounded-lg p-4">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-700 border border-red-600 text-red-100 rounded-lg p-4">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-700 border border-green-600 text-green-100 rounded-lg p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-700 border border-yellow-600 text-yellow-100 rounded-lg p-4">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            @if (session('info'))
                <div class="bg-blue-700 border border-blue-600 text-blue-100 rounded-lg p-4">
                    <p>{{ session('info') }}</p>
                </div>
            @endif
        </div>

        <!-- Workouts Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 mt-4">
            <!-- Title Section -->
            <h1 class="text-3xl font-semibold text-gray-100 mb-4 sm:mb-0 sm:w-1/2">Routines</h1>
            @if(auth()->user())
                @php
                    $workoutCount = \App\Models\Workout::where('user_id', auth()->id())->count();
                    $canCreate = auth()->user()->role_id === 2 || $workoutCount < 5;
                @endphp

                <!-- Buttons Section -->
                <div class="flex flex-wrap sm:flex-nowrap space-x-0 sm:space-x-4 gap-4 sm:gap-0 w-full sm:w-auto">
                    <!-- My Workouts Button -->
                    <a href="{{ route('workouts.my') }}" class="btn-extra flex items-center px-4 py-2 rounded-lg bg-gray-800 text-gray-200 transition duration-300 w-full sm:w-auto">
                        <i class="fa fa-folder mr-2"></i> My Workouts
                    </a>

                    <!-- Create Workout Button with + Icon -->
                    @if ($canCreate)
                        <a href="{{ route('workouts.create') }}" class="btn-extra flex items-center px-4 py-2 rounded-lg text-white transition duration-300 w-full sm:w-auto">
                            <i class="fa fa-plus mr-2"></i> Create Workout
                        </a>
                    @else
                        <button class="btn-extra flex items-center cursor-not-allowed px-4 py-2 rounded-lg bg-gray-400 text-gray-600 opacity-50 w-full sm:w-auto" disabled>
                            <i class="fa-solid fa-xmark mr-2"></i> Limit Reached
                        </button>
                    @endif
                </div>
            @endif
        </div>

        <!-- Search Form -->
        <div class="mb-6">
            <form action="{{ route('workouts.index') }}" method="GET" class="flex flex-col sm:flex-row items-center space-x-0 sm:space-x-4 w-full">
                <!-- Search Input (Full width) -->
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by title or description"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-gray-300">

                <!-- Search Button -->
                <button type="submit" class="mt-4 sm:mt-0 sm:ml-4 btn-extra w-full sm:w-auto text-white px-4 py-2 rounded-lg transition">
                    Search
                </button>

                <!-- Clear Search Button -->
                @if(isset($search) && $search !== '')
                    <a href="{{ route('workouts.index') }}" class="px-4 py-2 rounded-lg btn-extra transition">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Grid Layout: Responsive (1 column, 2 column, 3 column) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($workouts as $workout)
                <div class="bg-gray-800 p-4 sm:p-6 md:p-8 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <a href="{{ route('workouts.show', $workout->id) }}" class="block">
                        <!-- Workout Title -->
                        <h3 class="text-xl sm:text-2xl font-semibold text-gray-100 mb-3 capitalize">{{ $workout->title }}</h3>

                        <!-- Workout level (Focus) -->
                        <div class="text-sm mb-4 mt-4 uppercase font-semibold
                            @if($workout->focus == 'Beginner')
                                text-sky-400
                            @elseif($workout->focus == 'Intermediate')
                                text-orange-500
                            @elseif($workout->focus == 'Advanced')
                                text-red-500
                            @else
                                text-gray-500
                            @endif">
                            {{ $workout->focus }}
                        </div>

                        <!-- Workout Type -->
                        <div class="text-sm text-gray-500 mb-4 mt-4 uppercase font-semibold">
                            <i class="fa-solid fa-bullseye mr-1"></i> <span>{{ $workout->workout_type }}</span>
                        </div>

                        <!-- Muscle Groups -->
                        <div class="flex flex-wrap gap-3 mt-2">
                            @php
                                $muscleGroups = collect($workout->exercises)->map(function($exercise) {
                                    return $exercise->primaryMuscleGroup ? $exercise->primaryMuscleGroup->name : null;
                                })->filter()->unique();
                            @endphp
                            @forelse($muscleGroups as $muscle)
                                <span class="text-xs sm:text-sm text-gray-400">{{ $muscle }}</span>
                            @empty
                                <span class="text-xs sm:text-sm text-gray-500">No muscle groups listed.</span>
                            @endforelse
                        </div>
                    </a>

                    <!-- Action Links (for Edit & Delete) -->
                    @if (auth()->user() && auth()->user()->role_id === 2)
                        <div class="flex justify-between mt-6 text-xs sm:text-sm">
                            <a href="{{ route('workouts.edit', $workout->id) }}" class="text-yellow-400 hover:underline flex items-center">
                                <i class="fa fa-pencil-alt mr-2"></i> Edit
                            </a>
                            <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline flex items-center" onclick="return confirm('Are you sure you want to delete this workout?')">
                                    <i class="fa fa-trash mr-2"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $workouts->links() }}
        </div>
    </div>
@endsection
