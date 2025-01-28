@extends('layouts.app')

@section('meta_title', 'Basics Statistics | Calisthenics')
@section('meta_description', 'Check out the top 10 exercises based on the number of reps performed by the users. See who is leading the charts and get inspired.')
@section('meta_keywords', 'calisthenics, basics, statistics, top exercises, reps, users')

@section('content')
<div >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Page Title -->
        <div class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 text-white p-6 rounded-lg shadow-lg mb-8">
            <h1 class="text-4xl font-bold text-center mb-4 flex items-center justify-center">
                Top 10 Exercises Based on Reps
            </h1>
            <p class="text-center text-lg sm:text-xl">
                Dive into the world of calisthenics excellence! Discover the most performed exercises and be inspired by the top contributors.
                <span class="font-semibold">Sign up now</span> to track your progress and climb the ranks!
            </p>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
        <div class="alert alert-success mb-6 bg-gray-800 border border-gray-600 text-gray-300 rounded-md p-4">
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <!-- Statistics Section -->
        <div class="bg-gray-800 text-white p-6 sm:p-8 rounded-lg shadow-md">
            @php
            $exercises = [
                'Pull Ups' => $topPullUps,
                'Push Ups' => $topPushUps,
                'Dips' => $topDips,
                'Pistol Squats' => $topPistolSquats,
            ];

            $medals = [
                0 => ['color' => 'yellow', 'icon' => 'fa-trophy', 'label' => 'Gold'],
                1 => ['color' => 'gray', 'icon' => 'fa-medal', 'label' => 'Silver'],
                2 => ['color' => 'orange', 'icon' => 'fa-award', 'label' => 'Bronze'],
            ];
            @endphp

            <div id="exercise-accordion" class="space-y-6">
                @foreach ($exercises as $exerciseName => $entries)
                <div class="rounded-lg shadow-md border border-gray-700">
                    <button
                        class="w-full text-left font-semibold text-lg sm:text-xl py-3 px-4 bg-gray-900 hover:bg-gray-800 text-white rounded-t-lg flex justify-between items-center"
                        onclick="toggleAccordion('{{ Str::slug($exerciseName) }}')">
                        <span><i class="fa-solid fa-dumbbell text-gray-300"></i> {{ $exerciseName }}</span>
                        <i class="fa-solid fa-chevron-down text-gray-300"></i>
                    </button>
                    <ul id="{{ Str::slug($exerciseName) }}" class="hidden">
                        <!-- Top 3 Entries -->
                        @foreach ($entries as $index => $entry)
                        @if ($index < 3)
                        <li class="flex items-center justify-between py-3 px-4 border-b border-gray-700">
                            <div class="flex items-center space-x-4">
                                @if (array_key_exists($index, $medals))
                                <div class="text-center">
                                    <i class="fa-solid {{ $medals[$index]['icon'] }} text-{{ $medals[$index]['color'] }}-500 text-xl"></i>
                                    <p class="text-sm text-{{ $medals[$index]['color'] }}-600">{{ $medals[$index]['label'] }}</p>
                                </div>
                                @else
                                <span class="text-xl font-bold text-gray-300">#{{ $index + 1 }}</span>
                                @endif
                                <p class="font-semibold text-gray-300 text-sm"><a href="/profile/{{ $entry->user->id }}">{{ Str::title($entry->user->name) }}</a></p>
                            </div>
                            <p class="font-semibold text-gray-300">{{ $entry->reps }} reps</p>
                        </li>
                        @else
                        <li class="hidden view-all-{{ Str::slug($exerciseName) }} flex items-center justify-between py-3 px-4 border-b border-gray-700">
                            <div class="flex items-center space-x-4">
                                <span class="text-xl font-bold text-gray-300">#{{ $index + 1 }}</span>
                                <p class="font-semibold text-gray-300 text-sm"><a href="/profile/{{ $entry->user->id }}">{{ $entry->user->name }}</a></p>
                            </div>
                            <p class="font-semibold text-gray-300">{{ $entry->reps }} reps</p>
                        </li>
                        @endif
                        @endforeach

                        <!-- View All Button -->
                        @if (count($entries) > 3)
                        <li class="py-3 px-4 text-center">
                            <button
                                class="text-gray-400 hover:underline text-sm view-more-btn"
                                onclick="viewMore('{{ Str::slug($exerciseName) }}')">View All</button>
                        </li>
                        @endif
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function toggleAccordion(id) {
        const element = document.getElementById(id);
        const icon = element.previousElementSibling.querySelector('.fa-chevron-down');
        element.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }

    function viewMore(id) {
        document.querySelectorAll('.view-all-' + id).forEach(el => el.classList.remove('hidden'));
        document.querySelector('.view-more-btn').classList.add('hidden');
    }
</script>
@endsection
