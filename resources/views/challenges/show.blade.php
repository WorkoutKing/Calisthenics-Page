@extends('layouts.app')

@section('meta_title', $challenge->name ?? 'Calisthenics Challenge')
@section('meta_description',  $challenge->description ?? 'Join the challenge and test your calisthenics skills!')
@section('meta_keywords', 'calisthenics, challenges, fitness, workout, exercise')

@section('content')
    <div >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Challenge Information -->
            <div class="bg-gray-800 p-6 sm:p-8 rounded-lg shadow-lg border border-gray-700 hover:shadow-xl transition duration-200">
                <h3 class="text-2xl font-bold text-white">{{ $challenge->name }}</h3>
                <p class="text-gray-300 mt-4">{{ $challenge->description }}</p>
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-400">
                    <p><strong class="font-semibold">Start Date:</strong> {{ \Carbon\Carbon::parse($challenge->start_date)->toFormattedDateString() }}</p>
                    <p><strong class="font-semibold">End Date:</strong> {{ \Carbon\Carbon::parse($challenge->end_date)->toFormattedDateString() }}</p>
                    <p><strong class="font-semibold">Status:</strong> {{ ucfirst($challenge->status) }}</p>
                </div>
            </div>

            <!-- Challenge Join or Result Upload Logic -->
            @if ($canJoin)
                @if ($userJoined)
                    @if ($userResult)
                        @if ($userResult->approved)
                            <div class="bg-green-800 border-l-4 border-green-600 text-green-200 p-4 rounded-lg shadow-md">
                                <i class="fa-solid fa-check-circle mr-2"></i> Your result has been approved!
                            </div>
                        @else
                            <div class="bg-blue-800 border-l-4 border-blue-600 text-blue-200 p-4 rounded-lg shadow-md">
                                <i class="fa-solid fa-clock mr-2"></i> You have already uploaded your results. Waiting for approval.
                            </div>
                        @endif
                    @else
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 hover:shadow-xl transition duration-200">
                            <h4 class="text-lg font-semibold text-white">Upload Your Results</h4>
                            <form action="{{ route('challenges.complete', $challenge->id) }}" method="POST" class="mt-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="result" class="block text-sm font-medium text-gray-300">Your Result Video URL</label>
                                    <input name="result" id="result" class="mt-1 block w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                </div>
                                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                                    Submit Results
                                </button>
                            </form>
                        </div>
                    @endif
                @else
                    <form action="{{ route('challenges.join', $challenge->id) }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit" class="btn bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-150">
                            Join Challenge
                        </button>
                    </form>
                @endif
            @elseif ($challenge->status == 'pending')
                <div class="bg-yellow-800 border-l-4 border-yellow-600 text-yellow-200 p-4 rounded-lg shadow-md">
                    <i class="fa-solid fa-info-circle mr-2"></i> This challenge is pending and cannot be joined yet.
                </div>
            @elseif ($challenge->status == 'completed')
                <div class="bg-red-800 border-l-4 border-red-600 text-red-200 p-4 rounded-lg shadow-md">
                    <i class="fa-solid fa-times-circle mr-2"></i> This challenge has been completed and is no longer accepting participants.
                </div>
            @else
                <div class="bg-red-800 border-l-4 border-red-600 text-red-200 p-4 rounded-lg shadow-md">
                    <i class="fa-solid fa-exclamation-circle mr-2"></i> You cannot join this challenge at this time.
                </div>
            @endif
        </div>
    </div>
@endsection
