@extends('layouts.app')

@section('meta_title', $workout->seo_title ?? $workout->title)
@section('meta_description', $workout->seo_description ?? Str::limit($workout->description, 160))
@section('meta_keywords', $workout->seo_keywords ?? '')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 space-y-10">

        <!-- Workout Header Section -->
        <div class="bg-gray-800 p-4 sm:p-8 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
            <h1 class="text-2xl sm:text-4xl font-bold text-white mb-4">{{ $workout->title }}</h1>
            <p class="text-gray-400 text-lg">{{ $workout->description }}</p>

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
        </div>

        <!-- Exercises Section -->
        <div class="space-y-6">
            <h3 class="text-3xl text-gray-200 font-semibold">Workout Plan:</h3>
            @forelse($workout->exercises as $exercise)
                <div class="bg-gray-800 p-4 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="image-gif-position flex flex-col sm:flex-row items-start sm:items-center mb-4">
                        <!-- Media URL or Main Picture (Left Side) -->
                        @if($exercise->media_first_frame && $exercise->media_url)
                            <div class="w-[135px] h-[116px] flex-shrink-0 rounded-lg overflow-hidden mb-4 sm:mb-0 sm:mr-4 relative">
                                @if ($exercise->media_first_frame)
                                    <img src="{{ $exercise->media_first_frame }}" alt="Media for {{ $exercise->title }}" class="main-image">
                                @endif
                                @if ($exercise->media_url)
                                    <img src="{{ $exercise->media_url }}" alt="Media for {{ $exercise->title }}" class="media-image">
                                @endif
                            </div>
                        @elseif ($exercise->media_first_frame && !$exercise->media_url)
                            <div class="w-[135px] h-[116px] flex-shrink-0 rounded-lg overflow-hidden mb-4 sm:mb-0 sm:mr-4">
                                <img src="{{ $exercise->media_first_frame }}" alt="Media for {{ $exercise->title }}" class="w-full h-full object-cover">
                            </div>
                        @endif

                        <!-- Exercise Title and Link (Right Side) -->
                        <div class="flex-1">
                            <h4 class="text-2xl text-white font-semibold mb-2">
                                <a href="/exercises/{{ $exercise->id }}" class="hover:text-blue-400 transition duration-200">
                                    {{ $exercise->title }}
                                </a>
                            </h4>
                            <!-- Exercise Details Styled as Compact Workout Plan (Below Title) -->
                            <div class="text-gray-300 mb-4">
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                    <div>
                                        <span class="block text-sm text-gray-500 flex items-center">
                                            <i class="fa-solid fa-dumbbell mr-2"></i> Sets
                                        </span>
                                        <span class="block text-lg text-white font-semibold">{{ $exercise->pivot->sets }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-sm text-gray-500 flex items-center">
                                            <i class="fa-solid fa-repeat mr-2"></i> Reps
                                        </span>
                                        <span class="block text-lg text-white font-semibold">{{ $exercise->pivot->reps }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-sm text-gray-500 flex items-center">
                                            <i class="fa-solid fa-stopwatch mr-2"></i> Rest Time
                                        </span>
                                        <span class="block text-lg text-white font-semibold">{{ $exercise->pivot->rest_time }}s
                                            <span class="text-gray-500 text-xs">
                                                (Suggested Break)
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section Placed Uniformly Below -->
                    @if($exercise->pivot->note)
                    <div class="mt-4">
                        <span class="block text-sm text-gray-500 flex items-center">
                            <i class="fa-solid fa-pen mr-2"></i> Note
                        </span>
                        <p class="text-gray-300 text-md">
                            {{ $exercise->pivot->note }}
                        </p>
                    </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">No exercises added to this workout.</p>
            @endforelse
        </div>
    </div>
@endsection
