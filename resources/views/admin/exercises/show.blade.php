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
        </div>

        <div class="bg-gray-800 text-white p-4 sm:p-8 rounded-lg shadow-xl">
            <h1 class="text-3xl font-semibold text-gray-100 mb-6">{{ $exercise->title }}</h1>

            @if ($exercise->media_url)
                <div class="mb-6 flex justify-center">
                    <img src="{{ $exercise->media_url }}" alt="Media for {{ $exercise->title }}" class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
            @elseif ($exercise->media_first_frame)
                <div class="mb-6 flex justify-center">
                    <img src="{{ $exercise->media_first_frame }}" alt="Media for {{ $exercise->title }}" class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
            @endif

            <!-- Primary Muscle Group -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-200">Primary Muscle Group</h2>
                <p class="text-gray-300">{{ $exercise->primaryMuscleGroup->name }}</p>
            </div>

            <!-- Secondary Muscle Groups -->
            @if ($exercise->secondaryMuscleGroups->count() > 0)
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-200">Secondary Muscle Groups</h2>
                    <ul class="text-gray-300">
                        @foreach ($exercise->secondaryMuscleGroups as $group)
                            <li>{{ $group->name }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Description -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-200">Description</h2>
                <div class="change-format" id="editor">{!! $exercise->description !!}</div>
            </div>

            <!-- Back to Exercises Link -->
            <a href="{{ route('admin.exercises.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700 transition duration-300">Back to Exercise Library</a>
        </div>
    </div>
@endsection
