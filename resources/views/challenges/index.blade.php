@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        {{ __('Challenges') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow-md">
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-lg shadow-md">
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Active Challenges -->
            <section class="space-y-6">
                <h3 class="text-2xl font-bold text-blue-600">Active Challenges</h3>
                @if ($challenges->isEmpty())
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <p class="text-gray-600">No active challenges available at the moment. Please check back later!</p>
                    </div>
                @else
                    @foreach ($challenges as $challenge)
                        <div class="bg-white p-6 rounded-lg shadow-md border hover:shadow-lg transition duration-200">
                            <h4 class="text-xl font-semibold text-gray-800">{{ $challenge->name }}</h4>
                            <p class="text-gray-600 mt-2">{{ $challenge->description }}</p>
                            <div class="mt-4 grid grid-cols-2 gap-4 text-gray-600">
                                <p><span class="font-semibold">Start Date:</span> {{ \Carbon\Carbon::parse($challenge->start_date)->toFormattedDateString() }}</p>
                                <p><span class="font-semibold">End Date:</span> {{ \Carbon\Carbon::parse($challenge->end_date)->toFormattedDateString() }}</p>
                                <p><span class="font-semibold">Status:</span> {{ ucfirst($challenge->status) }}</p>
                            </div>

                            <!-- User-specific result messages -->
                            <div class="mt-4">
                                @if ($userResults->has($challenge->id))
                                    @if ($userResults[$challenge->id]->approved)
                                        <p class="text-green-600 font-medium mt-2">
                                            <i class="fa-solid fa-check-circle"></i> Result approved!
                                        </p>
                                    @else
                                        <p class="text-blue-600 font-medium mt-2">
                                            <i class="fa-solid fa-clock"></i> Waiting for result approval.
                                        </p>
                                    @endif
                                @elseif ($challenge->status == 'active' && now()->between($challenge->start_date, $challenge->end_date))
                                    @if ($challenge->participants->contains(auth()->id()))
                                        <p class="text-green-500 font-medium mt-2">You have joined this challenge!</p>
                                        <a href="{{ route('challenges.show', $challenge->id) }}" class="mt-4 btn bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                            Upload Your Results
                                        </a>
                                    @else
                                        <form action="{{ route('challenges.join', $challenge->id) }}" method="POST" class="inline-block mt-4">
                                            @csrf
                                            <button type="submit" class="btn bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                                Join Challenge
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>

                            <!-- Admin Actions -->
                            @if (auth()->user()->role_id == 2)
                                <div class="mt-6 flex flex-wrap gap-4">
                                    <a href="{{ route('challenges.edit', $challenge->id) }}" class="btn bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                    <form action="{{ route('challenges.updateStatus', $challenge->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PUT')
                                        <label for="status" class="text-sm font-medium text-gray-700 mr-2">Status</label>
                                        <select name="status" id="status" class="form-select rounded-md px-2 py-1">
                                            <option value="pending" {{ $challenge->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="active" {{ $challenge->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="completed" {{ $challenge->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <button type="submit" class="ml-2 btn bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                            Update
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </section>

            <!-- Previous Challenges -->
            <section class="space-y-6">
                <h3 class="text-2xl font-bold text-gray-800">Previous Challenges</h3>
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    @if ($previousChallenges->isEmpty())
                        <p class="text-gray-600">No previous challenges available.</p>
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
