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
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-semibold text-gray-800">Top 10 Exercises Based on Reps</h3>

                <!-- Top Pull Ups -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-800">Top 10 Pull Ups</h4>
                    <ul class="space-y-2 mt-2">
                        @foreach ($topPullUps as $index => $entry)
                            <li class="flex items-center p-4 rounded-lg shadow border
                                {{ $index == 0 ? 'bg-yellow-300 border-yellow-500' : '' }}
                                {{ $index == 1 ? 'bg-gray-300 border-gray-500' : '' }}
                                {{ $index == 2 ? 'bg-orange-300 border-orange-500' : '' }}
                                {{ $index >= 3 ? 'bg-gray-100 border-gray-300' : '' }}">

                                <!-- Medal Icons for Top 3 -->
                                @if ($index == 0)

                                    <span class="text-xl font-bold text-yellow-600">Gold</span>
                                @elseif ($index == 1)

                                    <span class="text-xl font-bold text-gray-600">Silver</span>
                                @elseif ($index == 2)

                                    <span class="text-xl font-bold text-orange-600">Bronze</span>
                                @else
                                    <span class="text-xl font-semibold text-gray-800">#{{ $index + 1 }}</span>
                                @endif

                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800">{{ $entry->user->name }}: {{ $entry->reps }} reps</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Top Push Ups -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-800">Top 10 Push Ups</h4>
                    <ul class="space-y-2 mt-2">
                        @foreach ($topPushUps as $index => $entry)
                            <li class="flex items-center p-4 rounded-lg shadow border
                                {{ $index == 0 ? 'bg-yellow-300 border-yellow-500' : '' }}
                                {{ $index == 1 ? 'bg-gray-300 border-gray-500' : '' }}
                                {{ $index == 2 ? 'bg-orange-300 border-orange-500' : '' }}
                                {{ $index >= 3 ? 'bg-gray-100 border-gray-300' : '' }}">

                                <!-- Medal Icons for Top 3 -->
                                @if ($index == 0)

                                    <span class="text-xl font-bold text-yellow-600">Gold</span>
                                @elseif ($index == 1)

                                    <span class="text-xl font-bold text-gray-600">Silver</span>
                                @elseif ($index == 2)

                                    <span class="text-xl font-bold text-orange-600">Bronze</span>
                                @else
                                    <span class="text-xl font-semibold text-gray-800">#{{ $index + 1 }}</span>
                                @endif

                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800">{{ $entry->user->name }}: {{ $entry->reps }} reps</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Top Dips -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-800">Top 10 Dips</h4>
                    <ul class="space-y-2 mt-2">
                        @foreach ($topDips as $index => $entry)
                            <li class="flex items-center p-4 rounded-lg shadow border
                                {{ $index == 0 ? 'bg-yellow-300 border-yellow-500' : '' }}
                                {{ $index == 1 ? 'bg-gray-300 border-gray-500' : '' }}
                                {{ $index == 2 ? 'bg-orange-300 border-orange-500' : '' }}
                                {{ $index >= 3 ? 'bg-gray-100 border-gray-300' : '' }}">

                                <!-- Medal Icons for Top 3 -->
                                @if ($index == 0)

                                    <span class="text-xl font-bold text-yellow-600">Gold</span>
                                @elseif ($index == 1)

                                    <span class="text-xl font-bold text-gray-600">Silver</span>
                                @elseif ($index == 2)

                                    <span class="text-xl font-bold text-orange-600">Bronze</span>
                                @else
                                    <span class="text-xl font-semibold text-gray-800">#{{ $index + 1 }}</span>
                                @endif

                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800">{{ $entry->user->name }}: {{ $entry->reps }} reps</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Top Pistol Squats -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-800">Top 10 Pistol Squats</h4>
                    <ul class="space-y-2 mt-2">
                        @foreach ($topPistolSquats as $index => $entry)
                            <li class="flex items-center p-4 rounded-lg shadow border
                                {{ $index == 0 ? 'bg-yellow-300 border-yellow-500' : '' }}
                                {{ $index == 1 ? 'bg-gray-300 border-gray-500' : '' }}
                                {{ $index == 2 ? 'bg-orange-300 border-orange-500' : '' }}
                                {{ $index >= 3 ? 'bg-gray-100 border-gray-300' : '' }}">

                                <!-- Medal Icons for Top 3 -->
                                @if ($index == 0)
                                    <span class="text-xl font-bold text-yellow-600">Gold</span>
                                @elseif ($index == 1)

                                    <span class="text-xl font-bold text-gray-600">Silver</span>
                                @elseif ($index == 2)

                                    <span class="text-xl font-bold text-orange-600">Bronze</span>
                                @else
                                    <span class="text-xl font-semibold text-gray-800">#{{ $index + 1 }}</span>
                                @endif

                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800">{{ $entry->user->name }}: {{ $entry->reps }} reps</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
