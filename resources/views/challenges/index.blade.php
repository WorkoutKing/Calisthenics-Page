@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Challenges') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Display success or error messages -->
            @if (session('success'))
                <div class="mb-4 text-sm font-medium text-green-600 bg-green-100 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-sm font-medium text-red-600 bg-red-100 p-4 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Challenges List -->
            @foreach ($challenges as $challenge)
                <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                    <div>
                        <h5 class="text-xl font-semibold">{{ $challenge->name }}</h5>
                        <p class="text-gray-700 mt-2">{{ $challenge->description }}</p>
                        <p class="text-gray-600 mt-2">Start Date: {{ \Carbon\Carbon::parse($challenge->start_date)->toDateString() }}</p>
                        <p class="text-gray-600 mt-2">End Date: {{ \Carbon\Carbon::parse($challenge->end_date)->toDateString() }}</p>
                        <p class="text-gray-600 mt-2">Status: {{ ucfirst($challenge->status) }}</p>

                        <!-- Check user result status -->
                        @if ($userResults->has($challenge->id))
                            @if ($userResults[$challenge->id]->approved)
                                <p class="text-green-500 mt-2">Result approved!</p>
                            @else
                                <p class="text-blue-500 mt-2">Waiting for approval of your results.</p>
                            @endif
                        @elseif ($challenge->status == 'active' && now()->between($challenge->start_date, $challenge->end_date))
                            @if ($challenge->participants->contains(auth()->id()))
                                <p class="text-green-500 mt-2">You have joined this challenge!</p>
                                <a href="{{ route('challenges.show', $challenge->id) }}" class="mt-4 inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:bg-blue-700">Upload Your Results</a>
                            @else
                                <form action="{{ route('challenges.join', $challenge->id) }}" method="POST" class="inline-block mt-4">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Join Challenge</button>
                                </form>
                            @endif
                        @elseif ($challenge->status == 'pending')
                            <p class="text-yellow-500 mt-2">Challenge is pending and not open for participation.</p>
                        @else
                            <p class="text-red-500 mt-2">Challenge is completed or no longer accepting participants.</p>
                        @endif

                        <!-- Admin or authorized user actions -->
                        @if (auth()->user()->role_id == 2)
                            <div class="mt-4">
                                <a href="{{ route('challenges.edit', $challenge->id) }}" class="btn btn-sm bg-yellow-500 text-white hover:bg-yellow-600 rounded px-4 py-2 inline-flex items-center justify-center">Edit</a>

                                <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm bg-red-500 text-white hover:bg-red-600 rounded px-4 py-2 inline-flex items-center justify-center">Delete</button>
                                </form>

                                <a href="/challenges/create" class="btn btn-sm bg-blue-500 text-white hover:bg-blue-600 rounded px-4 py-2 inline-flex items-center justify-center mt-4">Create New Challenge</a>
                            </div>
                            <!-- Status Update Form -->
                            <div class="mt-4">
                                <form action="{{ route('challenges.updateStatus', $challenge->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')

                                    <label for="status" class="text-sm font-medium text-gray-700" >Change Status</label>
                                    <select name="status" id="status" class="form-select mt-2 block w-full rounded-md">
                                        <option value="pending" {{ $challenge->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="active" {{ $challenge->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="completed" {{ $challenge->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>

                                    <button type="submit" class="mt-4 inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:bg-blue-700">Update Status</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
