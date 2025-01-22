@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">

    <!-- User Profile Section -->
    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col sm:flex-row items-center sm:space-x-6 space-y-4 sm:space-y-0 mb-8">
        <!-- User Profile Image -->
        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/def.jpg') }}" alt="Profile Picture" class="w-24 sm:w-32 h-24 sm:h-32 rounded-full object-cover border-2 border-gray-300">
        <div class="text-center sm:text-left">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800">{{ $user->name }}</h1>
            <p class="text-sm text-gray-600">Joined: {{ optional($user->created_at)->format('M d, Y') ?? 'N/A' }}</p>
            <p class="text-sm text-gray-600">
                @if($user->is_online)
                    <span class="text-green-500 font-bold">Online</span>
                @else
                    <span class="text-gray-500">Offline</span>
                    Last Login: {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'N/A' }}
                @endif
            </p>
        </div>
    </div>

    <!-- Profile Overview Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- User Level and Achievements Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-medium text-gray-800 mb-4">User Level</h3>
            <p class="text-lg text-gray-600 mb-2">
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
            <p class="text-sm font-semibold text-gray-700 mb-4">My earned points: {{ $totalPoints }} Points</p>

            <!-- Special Achievements Section -->
            @if ($latestAchievements->isEmpty())
                <p class="text-gray-600">This user has not earned any special achievements yet.</p>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($latestAchievements as $spec)
                        @if($spec->element->id == 1)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/hs.png') }}" alt="Handstand Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Handstand</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 3)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/hsm.png') }}" alt="Handstand Master Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Handstand Master</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 6)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/front.png') }}" alt="Front Lever Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Front Lever</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 7)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/frontm.png') }}" alt="Front Lever Master Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Front Lever Master</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 8)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/planche.png') }}" alt="Planche Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Planche</span>
                                </div>
                            </div>
                        @endif
                        @if($spec->element->id == 99)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/planchem.png') }}" alt="Planche Master Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Planche Master</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($exerciseProgress as $progress)
                        @if($progress['exercise'] ==  'pull ups' && $progress['userScore'] >= 40)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="path-to-your-image/pull-ups-god-badge.jpg" alt="Pull Ups God Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Pull Ups God</span>
                                </div>
                            </div>
                        @endif
                        @if($progress['exercise'] == 'dips' && $progress['userScore'] >= 100)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/dip.png') }}" alt="Dips God Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Dips God</span>
                                </div>
                            </div>
                        @endif
                        @if($progress['exercise'] == 'push ups' && $progress['userScore'] >= 200)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/pushups.png') }}" alt="Push Ups God Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Push Ups God</span>
                                </div>
                            </div>
                        @endif
                        @if($progress['exercise'] == 'pistol squats' && $progress['userScore'] >= 20)
                            <div class="flex flex-col items-center group">
                                <div class="w-21 h-21  clip-octagon relative ">
                                    <img src="{{ asset('storage/badges/pistolsquats.png') }}" alt="Push Ups God Badge" class="px-3 w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-sm">Pistol Squats Specialist</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Exercise Progress Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-medium text-gray-800 mb-4">Exercise Progress</h3>
            @foreach ($exerciseProgress as $progress)
                <div class="mb-4">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-medium text-gray-800">{{ ucfirst($progress['exercise']) }}</h4>
                        <span class="text-sm text-gray-600">{{ $progress['userScore'] }} / {{ $progress['globalMax'] }} (Ranked {{ $progress['rank'] }})</span>
                    </div>
                    <!-- Progress bar -->
                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden mt-2">
                        <div class="h-full bg-green-500" style="width: {{ $progress['globalMax'] > 0 ? ($progress['userScore'] / $progress['globalMax']) * 100 : 0 }}%;"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Achievements Section -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-medium text-gray-800 mb-4">All Earned Achievements</h3>

        @if ($latestAchievements->isEmpty())
            <p class="text-gray-600">This user has not earned any achievements yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($latestAchievements as $achievement)
                    <div class="flex items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                        <i class="fas fa-medal text-blue-500 text-2xl mr-4"></i>
                        <div>
                            <strong>{{ $achievement->element->name }}</strong>
                            <p class="text-sm text-gray-600">Earned on {{ $achievement->completed_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
