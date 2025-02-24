@extends('layouts.app')

@section('meta_title', 'Challenges | Calisthenics')
@section('meta_description', 'Explore active and previous challenges in calisthenics. Join now to participate and achieve your fitness goals!')
@section('meta_keywords', 'calisthenics, challenges, fitness, active lifestyle')

@section('content')
    <div >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="bg-green-600 border-l-4 border-green-800 text-white p-4 rounded-lg shadow-md">
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-gray-800 border-l-4 border-red-800 text-white p-4 rounded-lg shadow-md">
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Page Title and Description -->
            <div class="bg-gray-800 p-3 rounded-lg shadow-lg hover:shadow-xl transition duration-200 mb-8">
                <h1 class="text-3xl lg:text-4xl font-bold text-center mb-4">
                    Active Challenges
                </h1>
                <p class="text-center text-lg sm:text-xl text-gray-300">
                    Embark on a journey of exciting calisthenics challenges! Learn techniques step-by-step to conquer various elements.
                    Track your progress and earn rewards as you complete each challenge.
                    @guest
                        <span class="font-semibold">Sign up or log in</span> now to unlock your full potential and join the community!
                    @endguest
                </p>
            </div>

            <!-- Active Challenges -->
            <section class="space-y-8">
                @if ($challenges->isEmpty())
                    <div class="bg-gray-800 p-3 sm:p-8 rounded-lg shadow-md text-center">
                        <p class="text-gray-300">No active challenges available at the moment. Please check back later!</p>
                    </div>
                @else
                    @foreach ($challenges as $challenge)
                        <div class="bg-gray-800 p-3 sm:p-8 rounded-lg shadow-lg border hover:shadow-xl transition duration-200">
                            <h4 class="text-2xl font-bold text-white">{{ $challenge->name }}</h4>
                            <p class="text-gray-300 mt-3">{{ $challenge->description }}</p>
                            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-300">
                                <p><span class="font-semibold">Start Date:</span> {{ \Carbon\Carbon::parse($challenge->start_date)->toFormattedDateString() }}</p>
                                <p><span class="font-semibold">End Date:</span> {{ \Carbon\Carbon::parse($challenge->end_date)->toFormattedDateString() }}</p>
                                <p><span class="font-semibold">Status:</span> {{ ucfirst($challenge->status) }}</p>
                            </div>

                            <!-- User-specific result messages -->
                            <div class="mt-6">
                                @if (auth()->check())
                                    @if ($userResults->has($challenge->id))
                                        @if ($userResults[$challenge->id]->approved)
                                            <p class="text-green-500 font-medium">
                                                <i class="fa-solid fa-check-circle"></i> Your result has been approved!
                                            </p>
                                        @else
                                            <p class="text-blue-500 font-medium">
                                                <i class="fa-solid fa-clock"></i> Waiting for approval.
                                            </p>
                                        @endif
                                    @elseif (
                                        $challenge->status == 'active' &&
                                        (now()->between($challenge->start_date, $challenge->end_date) ||
                                        now()->subMinutes(30)->lte($challenge->start_date))
                                    )
                                        @if ($challenge->participants->contains(auth()->id()))
                                            <p class="text-green-400 font-medium mt-2 mb-2">You have joined this challenge!</p>
                                            <a href="{{ route('challenges.show', $challenge->id) }}" class="mt-4 btn bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                                Upload Your Results
                                            </a>
                                        @else
                                            <form action="{{ route('challenges.join', $challenge->id) }}" method="POST" class="inline-block mt-4">
                                                @csrf
                                                <button type="submit" class="btn bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                                    Join Challenge
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @else
                                    <p class="text-blue-500 font-medium mt-4">To participate in this challenge, please <a href="{{ route('login') }}" class="text-blue-700 underline">log in</a> or <a href="{{ route('register') }}" class="text-blue-700 underline">register</a>.</p>
                                @endif
                            </div>

                            <!-- Admin Actions -->
                            @if (auth()->check() && auth()->user()->role_id == 2)
                                <div class="mt-8 flex flex-wrap gap-4">
                                    <a href="{{ route('challenges.edit', $challenge->id) }}" class="btn bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
                                        Edit
                                    </a>
                                    <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                    <form action="{{ route('challenges.updateStatus', $challenge->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PUT')
                                        <label for="status" class="text-sm font-medium text-gray-300 mr-2">Status</label>
                                        <select name="status" id="status" class="form-select rounded-md px-2 py-1 text-gray-800">
                                            <option value="pending" {{ $challenge->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="active" {{ $challenge->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="completed" {{ $challenge->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <button type="submit" class="ml-2 btn bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
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
            <section class="space-y-8">
                <h3 class="text-3xl font-bold text-gray-300 border-b pb-2 border-gray-500">
                    Previous Challenges
                </h3>
                <div class="bg-gray-700 p-3 sm:p-8 rounded-lg shadow-lg">
                    @if ($previousChallenges->isEmpty())
                        <p class="text-gray-400 text-center">No previous challenges available.</p>
                    @else
                        <ul class="divide-y divide-gray-600">
                            @foreach ($previousChallenges as $challenge)
                                <li class="flex flex-wrap justify-between items-center">
                                    <span class="text-gray-300 font-medium">{{ $challenge->name }}</span>
                                    <span class="text-gray-400 text-sm">
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
