@extends('layouts.app')

@section('meta_title', 'Basics | Calisthenics')
@section('meta_description', 'Upload your basic exercise results and track your progress. Watch videos and learn how to perform the exercises.')
@section('meta_keywords', 'calisthenics, basics, exercises, results, progress, videos')

@section('content')
<div class="container mx-auto py-8 sm:py-12 space-y-8 sm:space-y-12 px-4 sm:px-6 lg:px-8">

    <!-- Notification Messages -->
    @if ($errors->any())
        <div class="bg-red-700 border border-red-600 text-red-200 rounded-lg p-4 shadow-md">
            <h3 class="font-semibold text-lg sm:text-xl mb-2">Oops! Something went wrong:</h3>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-700 border border-green-600 text-green-200 rounded-lg p-4 shadow-md flex items-center space-x-4">
            <i class="fas fa-check-circle text-2xl"></i>
            <p class="text-sm sm:text-base">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('warning'))
        <div class="bg-yellow-700 border border-yellow-600 text-yellow-200 rounded-lg p-4 shadow-md flex items-center space-x-4">
            <i class="fas fa-exclamation-circle text-2xl"></i>
            <p class="text-sm sm:text-base">{{ session('warning') }}</p>
        </div>
    @endif

    @if (session('info'))
        <div class="bg-blue-700 border border-blue-600 text-blue-200 rounded-lg p-4 shadow-md flex items-center space-x-4">
            <i class="fas fa-info-circle text-2xl"></i>
            <p class="text-sm sm:text-base">{{ session('info') }}</p>
        </div>
    @endif

    <!-- Basics Section -->
    <div>
        <!-- Page Title and Description -->
        <div class="bg-gray-800 p-3 rounded-lg shadow-lg hover:shadow-xl transition duration-200 mb-8">
            <h1 class="text-4xl font-bold text-center mb-4 text-white">
                Your Basics
            </h1>
            <p class="text-center text-lg sm:text-xl text-gray-300">
                Track your progress by uploading results for your basic calisthenics exercises. Watch instructional videos and stay consistent!
            </p>
        </div>

        @if ($basics->isEmpty())
            <div class="bg-gray-800 text-gray-400 p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-dumbbell text-4xl sm:text-5xl mb-4 text-gray-500"></i>
                <p class="text-lg sm:text-xl font-medium">No basic exercises available. Start by adding your results!</p>
            </div>
        @else
            @foreach ($basics as $basic)
                <div class="bg-gray-800 p-6 sm:p-8 rounded-lg shadow-md mb-6 flex justify-between items-center">
                    <div class="w-full sm:w-3/4">
                        <h3 class="text-2xl sm:text-3xl font-semibold text-gray-100">{{ $basic->exercise }}</h3>
                        <p class="text-gray-400 mt-2">
                            <a href="{{ $basic->video_url }}" target="_blank" class="text-blue-400 hover:underline">
                                Watch Video
                            </a>
                        </p>
                        <p class="text-gray-400 mt-2">{{ $basic->reps }} reps</p>
                        <p class="text-gray-400 mt-2">
                            Status:
                            <span class="{{ $basic->approved ? 'text-green-400 font-bold' : 'text-yellow-400 font-bold' }}">
                                {{ $basic->approved ? 'Approved' : 'Pending' }}
                            </span>
                        </p>
                    </div>
                    <i class="fas {{ $basic->approved ? 'fa-check-circle text-green-400' : 'fa-clock text-yellow-400' }} text-3xl sm:text-4xl"></i>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Upload Exercise Results Form -->
    <div class="bg-gray-800 p-6 sm:p-8 rounded-lg shadow-md">
        <h2 class="text-2xl sm:text-3xl font-semibold text-gray-100 mb-6">Upload Exercise Results</h2>

        <form action="{{ route('basics.upload') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Exercise Selection -->
            <div>
                <label for="exercise" class="block text-lg sm:text-xl font-medium text-gray-300">Select Exercise</label>
                <select name="exercise" id="exercise" class="form-select mt-2 p-3 block w-full bg-gray-700 text-white border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="pull ups" {{ old('exercise') == 'pull ups' ? 'selected' : '' }}>Pull Ups</option>
                    <option value="push ups" {{ old('exercise') == 'push ups' ? 'selected' : '' }}>Push Ups</option>
                    <option value="dips" {{ old('exercise') == 'dips' ? 'selected' : '' }}>Dips</option>
                    <option value="pistol squats" {{ old('exercise') == 'pistol squats' ? 'selected' : '' }}>Pistol Squats</option>
                </select>
                @error('exercise')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Reps Input -->
            <div>
                <label for="reps" class="block text-lg sm:text-xl font-medium text-gray-300">Repetitions</label>
                <input type="number" name="reps" id="reps" class="form-input mt-2 p-3 block w-full bg-gray-700 text-white border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('reps') }}">
                @error('reps')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Video URL Input -->
            <div>
                <label for="video_url" class="block text-lg sm:text-xl font-medium text-gray-300">Video URL</label>
                <input type="url" name="video_url" id="video_url" class="form-input mt-2 p-3 block w-full bg-gray-700 text-white border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('video_url') }}">
                @error('video_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 transition duration-150">
                    Upload Results
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
