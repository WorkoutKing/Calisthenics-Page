@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Your Achievements') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Achievements Card Section -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md mb-8">
                <h1 class="text-3xl font-semibold text-blue-600 dark:text-blue-400 mb-6 text-center">Your Achievements</h1>

                @if($achievements->isEmpty())
                    <div class="text-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-sad-tear text-5xl mb-4"></i>
                        <p class="text-lg">You havent earned any achievements yet. Keep going!</p>
                        <a href="/challenges" class="mt-6 inline-block bg-blue-600 text-white dark:bg-blue-700 dark:text-gray-200 px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 dark:hover:bg-blue-600 transition duration-300">
                            Explore Challenges
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($achievements as $achievement)
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                <div class="flex items-center mb-4">
                                    <!-- Achievement Icon -->
                                    <i class="fas fa-trophy text-yellow-500 text-4xl mr-4"></i>
                                    <div>
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $achievement->element->name }}</h2>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Completed on {{ $achievement->completed_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <!-- Description or Additional Details -->
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                    Great job! This achievement reflects your dedication and progress.
                                </p>
                                <!-- Badge -->
                                <div class="mt-4 flex items-center">
                                    <i class="fas fa-check-circle text-green-500 text-2xl mr-2"></i>
                                    <span class="text-green-600 dark:text-green-400 text-sm">Achievement Unlocked</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $achievements->links() }} <!-- Add Pagination Links -->
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
