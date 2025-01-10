@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">

    <!-- Error and Success Messages -->
    @if ($errors->any())
        <div class="alert alert-danger mb-6 bg-red-100 border border-red-400 text-red-700 rounded-md p-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mb-6 bg-green-100 border border-green-400 text-green-700 rounded-md p-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning mb-6 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-md p-4">
            <p>{{ session('warning') }}</p>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info mb-6 bg-blue-100 border border-blue-400 text-blue-700 rounded-md p-4">
            <p>{{ session('info') }}</p>
        </div>
    @endif

    <!-- Basics Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Your Basics</h1>

        @foreach ($basics as $basic)
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-semibold text-gray-800">{{ $basic->exercise }}</h3>
                <p class="text-gray-600 mt-2"><a href="{{ $basic->video_url }}" target="_blank" class="text-blue-600 hover:underline">{{ $basic->video_url }}</a></p>
                <p class="text-gray-600 mt-2">{{ $basic->reps }} reps</p>
                <p class="text-gray-600 mt-2">Status: <span class="{{ $basic->approved ? 'text-green-600' : 'text-yellow-600' }}">{{ $basic->approved ? 'Approved' : 'Pending' }}</span></p>
            </div>
        @endforeach
    </div>

    <!-- Upload Exercise Results Form -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Upload Exercise Results</h2>

        <form action="{{ route('basics.upload') }}" method="POST">
            @csrf

            <!-- Exercise Selection -->
            <div class="mt-4">
                <label for="exercise" class="block text-gray-700">Select Exercise</label>
                <select name="exercise" id="exercise" class="form-select mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
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
            <div class="mt-4">
                <label for="reps" class="block text-gray-700">Repetitions</label>
                <input type="number" name="reps" id="reps" class="form-input mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('reps') }}">
                @error('reps')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Video URL Input -->
            <div class="mt-4">
                <label for="video_url" class="block text-gray-700">Video URL</label>
                <input type="url" name="video_url" id="video_url" class="form-input mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('video_url') }}">
                @error('video_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="btn btn-primary py-2 px-4 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition duration-150 w-full md:w-auto">
                    Upload Results
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
