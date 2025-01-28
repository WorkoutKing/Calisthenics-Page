@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    <!-- User Profile Section -->
    <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-lg shadow-md flex flex-col sm:flex-row items-center sm:items-start sm:space-x-6 space-y-6 sm:space-y-0 mb-8">
        <!-- User Profile Image -->
        <div class="flex-shrink-0">
            <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('storage/profile_pictures/def.jpg') }}"
                alt="Profile Picture"
                class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
        </div>

        <!-- User Details -->
        <div class="text-center sm:text-left">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                Joined: {{ optional(auth()->user()->created_at)->format('M d, Y') ?? 'N/A' }}
            </p>
        </div>
    </div>

    <!-- Profile Overview Section -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Total Points Section -->
        <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-lg shadow-md">
            <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">User Level</h3>
            <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">
                @if ($totalPoints >= 700)
                    <strong>Level 5: Expert</strong> (Max Level)
                @elseif ($totalPoints >= 500)
                    <strong>Level 4: Advanced</strong>
                @elseif ($totalPoints >= 300)
                    <strong>Level 3: Intermediate</strong>
                @elseif ($totalPoints >= 100)
                    <strong>Level 2: Beginner</strong>
                @else
                    <strong>Level 1: Novice</strong>
                @endif
            </p>
            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mt-2">My earned points: {{ $totalPoints }} Points</p>

            <!-- Special Achievements -->
            @if ($latestAchievements->isEmpty())
                <p class="text-gray-600 mt-4">You have not earned any special achievements yet.</p>
            @else
                <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($latestAchievements as $spec)
                        @if($spec->element->id == 1)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/hs.png') }}" alt="Handstand Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Handstand</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 3)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/hsm.png') }}" alt="Handstand Master Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Handstand Master</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 6)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/front.png') }}" alt="Front Lever Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Front Lever</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 7)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/fill.png') }}" alt="Front Lever Master Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Front Lever Master</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 8)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/planche.png') }}" alt="Planche Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Planche</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 99)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/fill.png') }}" alt="Planche Master Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Planche Master</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($exerciseProgress as $progress)
                        @if($progress['exercise'] ==  'pull ups' && $progress['userScore'] >= 10)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/pullups.png') }}" alt="Pull Ups God Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Pull Ups God</span>
                                </div>
                            </div>
                        @endif
                        @if($progress['exercise'] == 'dips' && $progress['userScore'] >= 10)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/fill.png') }}" alt="Dips God Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Dips God</span>
                                </div>
                            </div>
                        @endif
                        @if($progress['exercise'] == 'push ups' && $progress['userScore'] >= 10)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/pushups.png') }}" alt="Push Ups God Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Push Ups God</span>
                                </div>
                            </div>
                        @endif
                        @if($progress['exercise'] == 'pistol squats' && $progress['userScore'] >= 10)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/fill.png') }}" alt="Push Ups God Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm text-white">Pistol Squats Specialist</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Exercise Progress Section -->
        <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-lg shadow-md">
            <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200 mb-4">Exercise Progress</h3>
            @foreach ($exerciseProgress as $progress)
                <div class="mb-4">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ ucfirst($progress['exercise']) }}</h4>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $progress['userScore'] }} / {{ $progress['globalMax'] }} (Ranked {{ $progress['rank'] }})</span>
                    </div>
                    <!-- Progress bar -->
                    <div class="h-2 rounded-full overflow-hidden mt-2 bg-gray-200 dark:bg-gray-700">
                        <div class="h-full bg-green-500" style="width: {{ $progress['globalMax'] > 0 ? ($progress['userScore'] / $progress['globalMax']) * 100 : 0 }}%;"></div>
                    </div>
                </div>
            @endforeach

            <!-- Link to Top Performers -->
            <div class="mt-6 text-center">
                <a href="/basics/statistics" class="text-blue-500 dark:text-blue-400 text-sm font-medium hover:underline">
                    View Top Performers
                </a>
            </div>
        </div>
    </div>

    <!-- Achievements Section -->
    <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-lg shadow-md">
        <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200 mb-4">Earned Achievements</h3>

        @if ($latestAchievements->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">You have not earned any achievements yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($latestAchievements as $achievement)
                    <div class="flex items-center bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <i class="fas fa-medal text-blue-500 text-2xl mr-4"></i>
                        <div>
                            <strong class="text-gray-800 dark:text-gray-300">{{ $achievement->element->name }}</strong>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Earned on {{ $achievement->completed_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Link to view all achievements -->
            @if ($allAchievementsCount > 6)
                <div class="mt-4 text-sm text-center">
                    <a href="achievements" class="text-blue-500 dark:text-blue-400 hover:underline">View All Achievements</a>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
