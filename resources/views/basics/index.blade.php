@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 space-y-12">

    <!-- Notification Messages -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 rounded-lg p-4 shadow-md">
            <h3 class="font-semibold text-lg mb-2">Oops! Something went wrong:</h3>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 rounded-lg p-4 shadow-md flex items-center space-x-4">
            <i class="fas fa-check-circle text-2xl"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('warning'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg p-4 shadow-md flex items-center space-x-4">
            <i class="fas fa-exclamation-circle text-2xl"></i>
            <p>{{ session('warning') }}</p>
        </div>
    @endif

    @if (session('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 rounded-lg p-4 shadow-md flex items-center space-x-4">
            <i class="fas fa-info-circle text-2xl"></i>
            <p>{{ session('info') }}</p>
        </div>
    @endif

    <!-- Basics Section -->
    <div>
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6">Your Basics</h1>

        @if ($basics->isEmpty())
            <div class="bg-gray-50 text-gray-600 p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-dumbbell text-5xl mb-4 text-gray-400"></i>
                <p class="text-lg font-medium">No basic exercises available. Start by adding your results!</p>
            </div>
        @else
            @foreach ($basics as $basic)
                <div class="bg-white p-6 rounded-lg shadow-md mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $basic->exercise }}</h3>
                        <p class="text-gray-600 mt-2">
                            <a href="{{ $basic->video_url }}" target="_blank" class="text-blue-600 hover:underline">
                                Watch Video
                            </a>
                        </p>
                        <p class="text-gray-600 mt-2">{{ $basic->reps }} reps</p>
                        <p class="text-gray-600 mt-2">
                            Status:
                            <span class="{{ $basic->approved ? 'text-green-600 font-bold' : 'text-yellow-600 font-bold' }}">
                                {{ $basic->approved ? 'Approved' : 'Pending' }}
                            </span>
                        </p>
                    </div>
                    <i class="fas {{ $basic->approved ? 'fa-check-circle text-green-500' : 'fa-clock text-yellow-500' }} text-4xl"></i>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Upload Exercise Results Form -->
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Upload Exercise Results</h2>

        <form action="{{ route('basics.upload') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Exercise Selection -->
            <div>
                <label for="exercise" class="block text-lg font-medium text-gray-700">Select Exercise</label>
                <select name="exercise" id="exercise" class="form-select mt-2 p-3 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
                <label for="reps" class="block text-lg font-medium text-gray-700">Repetitions</label>
                <input type="number" name="reps" id="reps" class="form-input mt-2 p-3 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('reps') }}">
                @error('reps')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Video URL Input -->
            <div>
                <label for="video_url" class="block text-lg font-medium text-gray-700">Video URL</label>
                <input type="url" name="video_url" id="video_url" class="form-input mt-2 p-3 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('video_url') }}">
                @error('video_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 transition duration-150">
                    Upload Results
                </button>
            </div>
        </form>
    </div>

</div>
@endsection