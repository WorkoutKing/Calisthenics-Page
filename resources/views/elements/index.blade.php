@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
        <i class="fa-solid fa-atom text-indigo-500 mr-2"></i> {{ __('Elements') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        @if ($errors->any())
            <div class="alert bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md">
                <strong>Oops!</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-md">
                <strong>Warning!</strong> {{ session('warning') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-md">
                <strong>Info:</strong> {{ session('info') }}
            </div>
        @endif

        <!-- Elements List -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h1 class="text-2xl font-bold mb-6 flex items-center">
                <i class="fa-solid fa-layer-group mr-2"></i> Elements
            </h1>

            <ul class="space-y-8">
                @foreach ($elements as $element)
                    <li class="bg-gray-50 p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fa-solid fa-cube mr-2"></i> {{ $element->name }}
                        </h2>
                        <p class="text-gray-700 mt-2">{{ $element->description }}</p>

                        <!-- Steps Section -->
                        <h3 class="mt-6 text-lg font-medium text-gray-800">Steps:</h3>
                        <ul class="space-y-4 mt-4">
                            @foreach ($element->steps as $step)
                                <li class="p-4 bg-white rounded-lg shadow-md hover:shadow-lg hover:bg-gray-100 transition duration-200">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $step->name }}
                                                <span class="text-sm text-gray-500">({{ $step->points }} points)</span>
                                            </p>
                                            <p class="text-gray-600 text-sm mt-1">{{ $step->criteria }}</p>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex space-x-3 items-center">
                                            @if (auth()->user()->role_id == 2)
                                                    <a href="{{ route('steps.edit', $step->id) }}" class="btn bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-150">
                                                        Edit
                                                    </a>
                                                <form action="{{ route('steps.destroy', $step->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-150">
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
                                                        <p class="text-green-600 font-medium">
                                                            <i class="fa-solid fa-check-circle"></i> ☆ You earned it! ☆
                                                        </p>
                                                        <!-- Delete Upload -->
                                                        <form action="{{ route('steps.destroyResult', $step->id) }}" method="POST" class="mt-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-150 w-full">
                                                                Delete Upload
                                                            </button>
                                                        </form>
                                                    @else
                                                        <p class="text-blue-600 font-medium">
                                                            <i class="fa-solid fa-clock"></i> Awaiting approval.
                                                        </p>
                                                    @endif
                                                </div>
                                            @else
                                                <a href="{{ route('steps.uploadResult', $step->id) }}" class="btn bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-150">
                                                    Upload Result
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Add Step Button -->
                        @if (auth()->user()->role_id == 2)
                            <div class="mt-6 text-right">
                                <a href="{{ route('steps.create', $element->id) }}" class="btn bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-150">
                                    Add Step
                                </a>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Add New Element Button -->
        @if (auth()->user()->role_id == 2)
            <div class="mt-8 text-center">
                <a href="/elements/create" class="btn bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-150 shadow-lg">
                    Add New Element
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
