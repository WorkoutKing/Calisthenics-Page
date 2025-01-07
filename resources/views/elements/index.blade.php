@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Elements') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-danger mb-6 bg-red-100 border border-red-400 text-red-700 rounded-md p-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Elements List Section -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h1 class="text-2xl font-bold text-blue-600 mb-6">Elements</h1>
                <ul class="space-y-8">
                    @foreach ($elements as $element)
                        <li class="bg-gray-50 p-6 rounded-lg shadow-md hover:bg-gray-100 transition duration-200 mb-6">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $element->name }}</h2>
                            <p class="text-gray-700 mt-2">{{ $element->description }}</p>

                            <h3 class="mt-4 text-lg font-medium text-gray-800">Steps:</h3>
                            <ul class="space-y-6 mt-4">
                                @foreach ($element->steps as $step)
                                    <li class="p-6 bg-white rounded-lg shadow hover:bg-gray-50 transition duration-200 mb-6">
                                        <div class="flex justify-between items-center">
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-800">{{ $step->name }} <span class="text-sm text-gray-500">({{ $step->points }} points)</span></p>
                                                <p class="text-gray-600 text-sm">{{ $step->criteria }}</p>
                                            </div>

                                            <div class="flex space-x-3 items-center">
                                                @if (auth()->user()->role_id == 2)
                                                    <div class="flex-1">
                                                        <a href="{{ route('steps.edit', $step->id) }}" class="btn btn-sm btn-warning text-yellow-600 hover:bg-yellow-200 transition duration-150 px-4 py-2 rounded-lg">Edit</a>
                                                    </div>
                                                    <div class="flex-1">
                                                        <form action="{{ route('steps.destroy', $step->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger text-red-600 hover:bg-red-200 transition duration-150 px-4 py-2 rounded-lg">Delete</button>
                                                        </form>
                                                    </div>
                                                @endif
                                                {{-- Check if the user has uploaded a result for this step --}}
                                                @php
                                                    $result = $step->results()->where('user_id', auth()->id())->first();
                                                @endphp

                                                @if ($result)
                                                    <div>
                                                        @if ($result->approved)
                                                            <p class="text-green-600 font-medium">Your result has been approved!</p>
                                                        @else
                                                            <p class="text-blue-600 font-medium">Your result is awaiting approval.</p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="flex-1">
                                                        <a href="{{ route('steps.uploadResult', $step->id) }}" class="btn btn-sm btn-primary text-white bg-green-600 hover:bg-blue-700 px-6 py-2 inline-block whitespace-nowrap text-center rounded-lg">
                                                            Upload Your Result
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            @if (auth()->user()->role_id == 2)
                                <!-- Add Step link -->
                                <div class="mt-4">
                                    <a href="{{ route('steps.create', $element->id) }}" class="btn btn-sm bg-indigo-600 text-white hover:bg-indigo-700 hover:rounded-lg w-full py-3 transition duration-150 rounded-lg px-6 py-2">
                                        Add Step
                                    </a>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            @if (auth()->user()->role_id == 2)
                <!-- Add New Element Button -->
                <div class="mt-8 text-center">
                    <div>
                        <a href="/elements/create" class="btn btn-lg bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-200 w-full max-w-xs mx-auto shadow-lg">Add New Element</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
