@extends('layouts.app')

@section('meta_title', 'Elements | Calisthenics')
@section('meta_description', 'Learn more about the elements in calisthenics. Check out the steps and upload your results to earn points.')
@section('meta_keywords', 'calisthenics, elements, steps, results, points')

@section('content')
<div >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Flash Messages -->
        @if ($errors->any())
            <div class="alert bg-red-900 border-l-4 border-red-600 text-red-100 p-4 mb-6 rounded-md">
                <strong>Oops!</strong>
                <ul class="mt-2 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert bg-green-900 border-l-4 border-green-600 text-green-100 p-4 mb-6 rounded-md">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert bg-blue-900 border-l-4 border-blue-600 text-blue-100 p-4 mb-6 rounded-md">
                <strong>Info!</strong> {{ session('info') }}
            </div>
        @endif

        <!-- Page Title and Description -->
        <div class="bg-gray-800 p-3 rounded-lg shadow-lg hover:shadow-xl transition duration-200 mb-8">
            <h1 class="text-3xl lg:text-4xl font-bold text-center mb-4">
                Explore Elements
            </h1>
            <p class="text-center text-lg lg:text-xl">
                Dive into the fascinating world of calisthenics! Learn, practice, and master various elements step by step. Earn points and track your progress as you grow.
                <br><br> <!-- Add line breaks for spacing -->
                <a href="/elements/statistics" class="font-bold text-blue-400 hover:text-blue-300 underline">Check out the top pantheon of elements</a>
            </p>
        </div>
        @if (auth()->user())
        @php
            $totalElements = $elements->count();
            $completedElements = $elements->filter(function($element) {
                return $element->steps->every(function($step) {
                    return $step->results()->where('user_id', auth()->id())->where('approved', true)->exists();
                });
            })->count();

            $overallCompletion = $totalElements ? round(($completedElements / $totalElements) * 100) : 0;
        @endphp

        <div class="bg-gray-800 p-3 sm:p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-200 mb-8">
            <h2 class="text-2xl font-bold text-center text-white">
                Completed Skills: {{ $completedElements }} / {{ $totalElements }}
            </h2>
            <div class="mt-2">
                <p class="text-sm text-gray-400">Completion: {{ $overallCompletion }}%</p>
                <div class="w-full bg-gray-600 rounded-full h-2 mt-1">
                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $overallCompletion }}%"></div>
                </div>
            </div>
        </div>
        @endif

        <!-- Elements List -->
        <div class="bg-gray-900 shadow-lg rounded-lg p-3 sm:p-8 mb-8">
            <ul class="space-y-8">
                @foreach ($elements as $index => $element)
                    @php
                        $totalSteps = $element->steps->count();
                        $completedSteps = $element->steps->filter(function($step) {
                            return $step->results()->where('user_id', auth()->id())->where('approved', true)->exists();
                        })->count();
                        $completionRate = $totalSteps ? round(($completedSteps / $totalSteps) * 100) : 0;
                    @endphp
                    <li class="bg-gray-800 p-3 rounded-lg shadow-lg hover:shadow-xl transition duration-200" x-data="{ open: {{ $index == 0 ? 'true' : 'false' }} }">
                        <h2 class="text-xl font-semibold text-gray-200 flex items-center justify-between">
                            <span>
                                <i class="fa-solid fa-cube mr-2"></i> {{ $element->name }}

                                @if ($element->exercise) <!-- Check if the element has an associated exercise -->
                                    <a href="/exercises/{{ $element->exercise->id }}" class="ml-2 text-sm text-gray-400">
                                        (<i class="fa-solid fa-link"></i> {{ $element->exercise->title }})
                                    </a>
                                    {{--  <span class="ml-1 relative group">
                                        <i class="fa-solid fa-circle-question text-blue-400 cursor-pointer"></i>
                                        <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-1 w-64 p-2 rounded-lg shadow-lg text-xs text-white bg-gray-800 opacity-0 group-hover:opacity-100 transition duration-300">
                                            This element is linked to the exercise: {{ $element->exercise->title }}
                                        </span>
                                    </span>  --}}
                                @endif
                            </span>
                            <button @click="open = !open" class="text-gray-300">
                                <i :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'"></i>
                            </button>
                        </h2>

                        @if (auth()->user())
                        <!-- Completion Progress -->
                        <div class="mt-2">
                            <p class="text-sm text-gray-400">Completion: {{ $completionRate }}%</p>
                            <div class="w-full bg-gray-600 rounded-full h-2 mt-1">
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ $completionRate }}%"></div>
                            </div>
                        </div>
                        @endif

                        <p class="text-gray-300 mt-2">{{ $element->description }}</p>

                        <!-- Steps Section -->
                        <div x-show="open" x-collapse>
                            <h3 class="mt-6 text-lg font-medium text-gray-200">Steps:</h3>
                            <ul class="space-y-4 mt-4">
                                @foreach ($element->steps as $step)
                                    <li class="p-3 bg-gray-700 rounded-lg shadow-md hover:shadow-lg hover:bg-gray-600 transition duration-200">
                                        <div class="flex flex-wrap justify-between items-center">
                                            <div class="mb-4 sm:mb-0">
                                                <!-- Step Name, Exercise Link, and Tooltip side by side -->
                                                <div class="flex flex-wrap items-center">
                                                    <p class="font-medium text-gray-200 mr-2">{{ $step->name }}</p>

                                                    @if ($step->exercise)
                                                        <!-- Inline on desktop, breaks to next line if it doesnt fit -->
                                                        <a href="/exercises/{{ $step->exercise->id }}" class="text-sm text-gray-400 hover:text-gray-200 transition duration-200">
                                                            (<i class="fa-solid fa-link"></i> {{ $step->exercise->title }})
                                                        </a>
                                                    @endif
                                                </div>

                                                @auth
                                                <!-- Points Section - Below the Step Name -->
                                                <p class="text-sm text-gray-400 mt-1">
                                                    After approval, you will get <span class="font-medium text-gray-200">{{ $step->points }} points</span>.
                                                </p>
                                                @endauth

                                                <!-- Step Criteria -->
                                                <p class="text-gray-400 text-sm mt-1">{{ $step->criteria }}</p>
                                            </div>
                                            @auth
                                                <div class="flex flex-wrap space-x-3 items-center">
                                                    @if (auth()->user()->role_id == 2)
                                                        <!-- Admin Actions -->
                                                        <a href="{{ route('steps.edit', $step->id) }}" class="btn btn-extra text-white px-4 py-2 rounded-lg transition duration-150">
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('steps.destroy', $step->id) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-extra text-white px-4 py-2 rounded-lg transition duration-150">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @php
                                                        $result = $step->results()->where('user_id', auth()->id())->first();
                                                    @endphp

                                                    @if ($result)
                                                        <div>
                                                            @if ($result->approved)
                                                                <p class="text-green-500 font-medium">
                                                                    <i class="fa-solid fa-check-circle"></i> ☆ You earned it! ☆
                                                                </p>
                                                                <form action="{{ route('steps.destroyResult', $step->id) }}" method="POST" class="mt-2">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-extra text-white px-4 py-2 rounded-lg transition duration-150 w-full">
                                                                        Delete Upload
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <p class="text-blue-500 font-medium">
                                                                    <i class="fa-solid fa-clock"></i> Awaiting approval.
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <a href="{{ route('steps.uploadResult', $step->id) }}" class="btn btn-extra text-white px-6 py-2 rounded-lg transition duration-150">
                                                            Upload Result
                                                        </a>
                                                    @endif
                                                </div>
                                            @endauth
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @auth
                            @if (auth()->user()->role_id == 2)
                                <div class="mt-6 mb-4 text-right">
                                    <a href="{{ route('steps.create', $element->id) }}" class="btn btn-extra text-white px-6 py-3 rounded-lg transition duration-150">
                                        Add Step
                                    </a>
                                </div>
                            @endif
                        @endauth
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Add New Element Button for Admin -->
        @auth
            @if (auth()->user()->role_id == 2)
                <div class="mt-8 text-center">
                    <a href="/elements/create" class="btn btn-extra text-white py-3 px-6 rounded-lg transition duration-150 shadow-lg">
                        Add New Element
                    </a>
                </div>
            @endif
        @endauth
    </div>
</div>
@endsection
