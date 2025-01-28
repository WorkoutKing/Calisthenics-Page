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
            <h1 class="text-4xl font-bold text-center mb-4 text-white">
                Explore Elements
            </h1>
            <p class="text-center text-lg sm:text-xl text-gray-300">
                Dive into the fascinating world of calisthenics! Learn, practice, and master various elements step by step. Earn points and track your progress as you grow.
                <br><br> <!-- Add line breaks for spacing -->
                <a href="/elements/statistics" class="font-bold text-blue-400 hover:text-blue-300 underline">Check out the top pantheon of elements</a>
            </p>
        </div>

        <!-- Elements List -->
        <div class="bg-gray-900 shadow-lg rounded-lg p-4 mb-8">
            <ul class="space-y-8">
                @foreach ($elements as $element)
                    <li class="bg-gray-800 p-3 rounded-lg shadow-lg hover:shadow-xl transition duration-200">
                        <h2 class="text-xl font-semibold text-gray-200 flex items-center">
                            <i class="fa-solid fa-cube mr-2"></i> {{ $element->name }}
                        </h2>
                        <p class="text-gray-300 mt-2">{{ $element->description }}</p>

                        <!-- Steps Section -->
                        <h3 class="mt-6 text-lg font-medium text-gray-200">Steps:</h3>
                        <ul class="space-y-4 mt-4">
                            @foreach ($element->steps as $step)
                                <li class="p-3 bg-gray-700 rounded-lg shadow-md hover:shadow-lg hover:bg-gray-600 transition duration-200">
                                    <div class="flex flex-wrap justify-between items-center">
                                        <div class="mb-4 sm:mb-0">
                                            <p class="font-medium text-gray-200">{{ $step->name }}
                                                <span class="text-sm text-gray-400">({{ $step->points }} points)</span>
                                            </p>
                                            <p class="text-gray-400 text-sm mt-1">{{ $step->criteria }}</p>
                                        </div>

                                        @auth
                                            <!-- Actions for Authenticated Users -->
                                            <div class="flex flex-wrap space-x-3 items-center">
                                                @if (auth()->user()->role_id == 2)
                                                    <!-- Admin Actions -->
                                                    <a href="{{ route('steps.edit', $step->id) }}" class="btn bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition duration-150">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('steps.destroy', $step->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-150">
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
                                                            <!-- Delete Upload -->
                                                            <form action="{{ route('steps.destroyResult', $step->id) }}" method="POST" class="mt-2">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-150 w-full">
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
                                                    <a href="{{ route('steps.uploadResult', $step->id) }}" class="btn bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-150">
                                                        Upload Result
                                                    </a>
                                                @endif
                                            </div>
                                        @endauth
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Add Step Button for Admin -->
                        @auth
                            @if (auth()->user()->role_id == 2)
                                <div class="mt-6 text-right">
                                    <a href="{{ route('steps.create', $element->id) }}" class="btn bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-150">
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
                    <a href="/elements/create" class="btn bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-150 shadow-lg">
                        Add New Element
                    </a>
                </div>
            @endif
        @endauth
    </div>
</div>
@endsection
