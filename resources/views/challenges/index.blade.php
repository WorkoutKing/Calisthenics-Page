@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Challenges') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="mb-4 text-sm font-medium text-green-600 bg-green-100 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-sm font-medium text-red-600 bg-red-100 p-4 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Active Challenges -->
            <section class="mb-12">
                <h3 class="text-lg font-semibold mb-4">Active Challenges</h3>
                @if ($challenges->isEmpty())
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                        <p class="text-gray-700">No active challenges available at the moment. Please check back later!</p>
                    </div>
                @else
                    @foreach ($challenges as $challenge)
                        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                            <h5 class="text-xl font-semibold">{{ $challenge->name }}</h5>
                            <p class="text-gray-700 mt-2">{{ $challenge->description }}</p>
                            <p class="text-gray-600 mt-2">Start Date: {{ \Carbon\Carbon::parse($challenge->start_date)->toDateString() }}</p>
                            <p class="text-gray-600 mt-2">End Date: {{ \Carbon\Carbon::parse($challenge->end_date)->toDateString() }}</p>
                            <p class="text-gray-600 mt-2">Status: {{ ucfirst($challenge->status) }}</p>

                            <!-- User-specific result messages -->
                            @if ($userResults->has($challenge->id))
                                @if ($userResults[$challenge->id]->approved)
                                    <p class="text-green-500 mt-2">Result approved!</p>
                                @else
                                    <p class="text-blue-500 mt-2">Waiting for approval of your results.</p>
                                @endif
                            @elseif ($challenge->status == 'active' && now()->between($challenge->start_date, $challenge->end_date))
                                @if ($challenge->participants->contains(auth()->id()))
                                    <p class="text-green-500 mt-2">You have joined this challenge!</p>
                                    <a href="{{ route('challenges.show', $challenge->id) }}" class="mt-4 inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:bg-blue-700">Upload Your Results</a>
                                @else
                                    <form action="{{ route('challenges.join', $challenge->id) }}" method="POST" class="inline-block mt-4">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Join Challenge</button>
                                    </form>
                                @endif
                            @endif

                            <!-- Admin Actions -->
                            @if (auth()->user()->role_id == 2)
                                <div class="mt-4 flex flex-wrap gap-4">
                                    <a href="{{ route('challenges.edit', $challenge->id) }}" class="btn btn-sm bg-yellow-500 text-white hover:bg-yellow-600 rounded px-4 py-2">Edit</a>
                                    <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm bg-red-500 text-white hover:bg-red-600 rounded px-4 py-2">Delete</button>
                                    </form>
                                    <form action="{{ route('challenges.updateStatus', $challenge->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')

                                        <label for="status" class="text-sm font-medium text-gray-700 mr-2">Change Status</label>
                                        <select name="status" id="status" class="form-select rounded-md">
                                            <option value="pending" {{ $challenge->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="active" {{ $challenge->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="completed" {{ $challenge->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>

                                        <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 ml-2">Update</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </section>

            <!-- Previous Challenges -->
            <section>
                <h3 class="text-lg font-semibold mb-4">Previous Challenges</h3>
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    @if ($previousChallenges->isEmpty())
                        <p class="text-gray-700">No previous challenges available.</p>
                    @else
                        <ul class="divide-y divide-gray-200">
                            @foreach ($previousChallenges as $challenge)
                                <li class="py-4 flex justify-between items-center">
                                    <span class="text-gray-800 font-medium">{{ $challenge->name }}</span>
                                    <span class="text-gray-600 text-sm">
                                        {{ $challenge->completed_count ?? 0 }} {{ Str::plural('person', $challenge->completed_count) }} completed
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
