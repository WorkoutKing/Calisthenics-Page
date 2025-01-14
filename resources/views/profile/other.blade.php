@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">

    <!-- User Profile Section -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-6 mb-8">
        <!-- User Profile Image -->
        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/def.jpg') }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-2 border-gray-300">
        <div>
            <h1 class="text-3xl font-semibold text-gray-800">{{ $user->name }}</h1>
        <p class="text-sm text-gray-600">Joined: {{ optional($user->created_at)->format('M d, Y') ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Profile Overview Section -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Total Points Section -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div class="flex flex-col items-start space-y-6 lg:space-y-0">
                <div class="mb-6">
                    <h3 class="text-xl font-medium text-gray-800">User Level</h3>

                    <!-- Determine User Level based on Total Points -->
                    <p class="text-lg text-gray-600">
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
                    <p class="text-sm font-semibold text-gray-700">My earned points: {{ $totalPoints }} Points</p>
                </div>

                <!-- Special Achievements Section Inside Level Block -->
                @if ($latestAchievements->isEmpty())
                    <p class="text-gray-600">This user has not earned any special achievements yet.</p>
                @else
                    <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($latestAchievements as $spec)
                            @if($spec->element->id == 1)
                                <div class="flex flex-col items-center group">
                                    <div class="w-20 h-20 bg-gray-200 clip-octagon relative shadow-md">
                                        <img src="path-to-your-image/handstand-badge.jpg" alt="Handstand Badge" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="mt-2 text-center">
                                        <span>Handstand</span>
                                    </div>
                                </div>
                            @endif
                            @if($spec->element->id == 2)
                                <div class="flex flex-col items-center group">
                                    <div class="w-20 h-20 bg-gray-200 clip-octagon relative shadow-md">
                                        <img src="path-to-your-image/handstand-master-badge.jpg" alt="Handstand Master Badge" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="mt-2 text-center">
                                        <span>Handstand Master</span>
                                    </div>
                                </div>
                            @endif
                            @if($spec->element->id == 3)
                                <div class="flex flex-col items-center group">
                                    <div class="w-20 h-20 bg-gray-200 clip-octagon relative shadow-md">
                                        <img src="path-to-your-image/front-lever-badge.jpg" alt="Front Lever Badge" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="mt-2 text-center">
                                        <span>Front Lever</span>
                                    </div>
                                </div>
                            @endif
                            @if($spec->element->id == 4)
                                <div class="flex flex-col items-center group">
                                    <div class="w-20 h-20 bg-gray-200 clip-octagon relative shadow-md">
                                        <img src="path-to-your-image/front-lever-master-badge.jpg" alt="Front Lever Master Badge" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="mt-2 text-center">
                                        <span>Front Lever Master</span>
                                    </div>
                                </div>
                            @endif
                            @if($spec->element->id == 5)
                                <div class="flex flex-col items-center group">
                                    <div class="w-20 h-20 bg-gray-200 clip-octagon relative shadow-md">
                                        <img src="path-to-your-image/planche-badge.jpg" alt="Planche Badge" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="mt-2 text-center">
                                        <span>Planche</span>
                                    </div>
                                </div>
                            @endif
                            @if($spec->element->id == 6)
                                <div class="flex flex-col items-center group">
                                    <div class="w-20 h-20 bg-gray-200 clip-octagon relative shadow-md">
                                        <img src="path-to-your-image/planche-master-badge.jpg" alt="Planche Master Badge" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="mt-2 text-center">
                                        <span>Planche Master</span>
                                    </div>
                                </div>
                            @endif
                            @if($spec->element->id == 7)
                                <div class="flex flex-col items-center group">
                                    <div class="w-20 h-20 bg-gray-200 clip-octagon relative shadow-md">
                                        <img src="path-to-your-image/pull-ups-god-badge.jpg" alt="Pull Ups God Badge" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="mt-2 text-center">
                                        <span>Pull Ups God 40</span>
                                    </div>
                                </div>
                            @endif
                            @if($spec->element->id == 8)
                                <div class="flex flex-col items-center group">
                                    <div class="w-20 h-20 bg-gray-200 clip-octagon relative shadow-md">
                                        <img src="path-to-your-image/dips-god-badge.jpg" alt="Dips God Badge" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="mt-2 text-center">
                                        <span>Dips God 100</span>
                                    </div>
                                </div>
                            @endif
                            @if($spec->element->id == 9)
                                <div class="flex flex-col items-center group">
                                    <div class="w-20 h-20 bg-gray-200 clip-octagon relative shadow-md">
                                        <img src="path-to-your-image/push-ups-god-badge.jpg" alt="Push Ups God Badge" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="mt-2 text-center">
                                        <span>Push Ups God 200</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
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
    {{--  <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-medium text-gray-800 mb-4">Latest Earned Achievements</h3>

        @if ($latestAchievements->isEmpty())
            <p class="text-gray-600">This user has not earned any achievements yet.</p>
        @else
            <ul>
                @foreach ($latestAchievements as $achievement)
                    <li class="flex items-center space-x-4 mb-4">
                        <i class="fas fa-medal text-blue-500 text-xl"></i>
                        <div>
                            <strong>{{ $achievement->element->name }}:</strong>
                            <p class="text-sm text-gray-600">Earned on {{ $achievement->completed_at->format('M d, Y') }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Link to view all achievements -->
            @if ($allAchievementsCount > 6)
                <div class="mt-4 text-sm">
                    <a href="achievements" class="text-blue-500 hover:underline">View All Achievements</a>
                </div>
            @endif
        @endif
    </div>  --}}

</div>
<style>
/* Custom class to create octagon shape */
.clip-octagon {
    clip-path: polygon(50% 0%, 100% 20%, 100% 80%, 50% 100%, 0% 80%, 0% 20%);
}

</style>
@endsection
