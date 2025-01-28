@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-100 leading-tight">
        {{ __('Upload Result for Step:') }}  {{$step->name }}
    </h2>
@endsection

@section('content')
    <div >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added px-4 for mobile padding -->

            <!-- Page Title and Description -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200 mb-8">
                <h1 class="text-4xl font-bold text-center mb-4 text-white">
                    Upload Your Result
                </h1>
                <p class="text-center text-lg sm:text-xl text-gray-300">
                    Share your progress for the step <strong>{{ $step->name }}</strong>. Upload a video or enter your reps/time to keep track of your achievements and continue advancing in your fitness journey.
                </p>
            </div>

            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-100"> <!-- Adjusted padding for mobile -->

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

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                            Upload Your Result
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
