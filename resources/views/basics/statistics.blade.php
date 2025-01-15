@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Statistics') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="alert alert-success mb-6 bg-green-100 border border-green-400 text-green-700 rounded-md p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Statistics Section -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    <i class="fa-solid fa-chart-line text-green-500"></i> Top 10 Exercises Based on Reps
                </h3>

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

                @foreach ($exercises as $exerciseName => $entries)
                    <div class="mt-8">
                        <h4 class="font-semibold text-gray-800 text-lg">
                            <i class="fa-solid fa-dumbbell text-blue-500"></i> Top 10 {{ $exerciseName }}
                        </h4>
                        <ul class="space-y-2 mt-4">
                            @foreach ($entries as $index => $entry)
                                <li class="flex items-center justify-between p-4 rounded-lg shadow border
                                    {{ $index == 0 ? 'bg-yellow-100 border-yellow-400' : '' }}
                                    {{ $index == 1 ? 'bg-gray-100 border-gray-400' : '' }}
                                    {{ $index == 2 ? 'bg-orange-100 border-orange-400' : '' }}
                                    {{ $index >= 3 ? 'bg-gray-50 border-gray-300' : '' }}">

                                    <!-- Medal/Rank -->
                                    <div class="flex items-center space-x-4">
                                        @if (array_key_exists($index, $medals))
                                            <div class="text-center">
                                                <i class="fa-solid {{ $medals[$index]['icon'] }} text-{{ $medals[$index]['color'] }}-500 text-xl"></i>
                                                <p class="text-sm text-{{ $medals[$index]['color'] }}-600">{{ $medals[$index]['label'] }}</p>
                                            </div>
                                        @else
                                            <span class="text-xl font-bold text-gray-800">#{{ $index + 1 }}</span>
                                        @endif

                                        <!-- User Name -->
                                        <p class="font-semibold text-gray-800"><a href="/profile/{{ $entry->user->id }}">{{ $entry->user->name }}</a></p>
                                    </div>

                                    <!-- Reps -->
                                    <p class="font-semibold text-gray-700">{{ $entry->reps }} reps</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
