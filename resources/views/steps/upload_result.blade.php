@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-100 leading-tight">
        {{ __('Upload Result for Step:') }}  {{$step->name }}
    </h2>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Page Title and Description -->
        <div class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 text-white p-3 rounded-lg shadow-lg mb-8">
            <h1 class="text-3xl lg:text-4xl font-bold text-center mb-4">
                Upload Your Result
            </h1>
            <p class="text-center text-lg lg:text-xl">
                Share your progress for the step <strong>{{ $step->name }}</strong>. Upload a video or enter your reps/time to keep track of your achievements and continue advancing in your fitness journey.
            </p>
        </div>

        <div class="bg-gray-800 text-white p-4 sm:p-8 rounded-lg shadow-xl">
            <div class="text-gray-100">

                <!-- Display Errors -->
                @if ($errors->any())
                    <div class="mb-4 text-sm font-medium text-red-600 bg-red-700 p-4 sm:rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form for uploading result -->
                <form method="POST" action="{{ route('steps.storeResult', $step->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="video_url" class="block text-sm font-medium text-gray-300">Video URL (Optional)</label>
                        <input type="text" name="video_url" id="video_url" value="{{ old('video_url') }}" placeholder="Enter a video URL" class="mt-1 p-2 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="reps_time" class="block text-sm font-medium text-gray-300">Reps or Time</label>
                        <input type="number" name="reps_time" id="reps_time" value="{{ old('reps_time') }}" placeholder="Enter number of reps or time in seconds" class="mt-1 p-2 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <button type="submit" class="px-4 py-2 btn-extra text-white rounded-md transition duration-200">
                        Upload Your Result
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
