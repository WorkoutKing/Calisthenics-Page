@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $challenge->name }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Challenge Information -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-semibold">{{ $challenge->name }}</h3>
                <p class="text-gray-700 mt-2">{{ $challenge->description }}</p>
                <p class="text-gray-600 mt-2"><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($challenge->start_date)->toDateString() }}</p>
                <p class="text-gray-600 mt-2"><strong>End Date:</strong> {{ \Carbon\Carbon::parse($challenge->end_date)->toDateString() }}</p>
                <p class="text-gray-600 mt-2"><strong>Status:</strong> {{ ucfirst($challenge->status) }}</p>
            </div>

            <!-- Challenge Join or Result Upload Logic -->
            @if ($canJoin)
                @if ($userJoined)
                    @if ($userResult)
                        @if ($userResult->approved)
                            <div class="bg-green-100 text-green-700 p-4 rounded-lg">
                                Your result has been approved!
                            </div>
                        @else
                            <div class="bg-blue-100 text-blue-700 p-4 rounded-lg">
                                You have already uploaded your results. Waiting for approval.
                            </div>
                        @endif
                    @else
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold">Upload Your Results</h4>
                            <form action="{{ route('challenges.complete', $challenge->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="result" class="block text-sm font-medium text-gray-700">Your Result</label>
                                    <textarea name="result" id="result" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                                </div>
                                <button type="submit" class="mt-4 inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:bg-blue-700"">Submit Results</button>
                            </form>
                        </div>
                    @endif
                @else
                    <form action="{{ route('challenges.join', $challenge->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Join Challenge</button>
                    </form>
                @endif
            @elseif ($challenge->status == 'pending')
                <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg mt-4">
                    This challenge is pending and cannot be joined yet.
                </div>
            @elseif ($challenge->status == 'completed')
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mt-4">
                    This challenge has been completed and is no longer accepting participants.
                </div>
            @else
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mt-4">
                    You cannot join this challenge at this time.
                </div>
            @endif
        </div>
    </div>
@endsection
