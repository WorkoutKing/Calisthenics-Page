@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Upload Result for Step:') }} {{ $step->name }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Display Errors -->
                    @if ($errors->any())
                        <div class="mb-4 text-sm font-medium text-red-600 bg-red-100 p-4 rounded-lg">
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
                            <label for="video_url" class="block text-sm font-medium text-gray-700">Video URL (Optional)</label>
                            <input type="text" name="video_url" id="video_url" value="{{ old('video_url') }}" placeholder="Enter a video URL" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="reps" class="block text-sm font-medium text-gray-700">Reps</label>
                            <input type="number" name="reps" id="reps" value="{{ old('reps') }}" placeholder="Enter number of reps (optional)" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="time" class="block text-sm font-medium text-gray-700">Time (Seconds)</label>
                            <input type="number" name="time" id="time" step="0.1" value="{{ old('time') }}" placeholder="Enter time in seconds (optional)" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Upload Your Result
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
