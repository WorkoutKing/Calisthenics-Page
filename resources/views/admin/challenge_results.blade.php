@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="alert alert-danger mb-6 bg-red-100 border border-red-400 text-red-700 rounded-md p-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mb-6 bg-green-100 border border-green-400 text-green-700 rounded-md p-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning mb-6 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-md p-4">
                <p>{{ session('warning') }}</p>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info mb-6 bg-blue-100 border border-blue-400 text-blue-700 rounded-md p-4">
                <p>{{ session('info') }}</p>
            </div>
        @endif
        <!-- Pending Challenge Results Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-3xl font-semibold mb-6">Pending Challenge Results</h2>

                @foreach ($challengeResults as $result)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
                        <h5 class="text-xl font-medium text-gray-800 mb-2">{{ $result->user->name }} - Challenge Result</h5>
                        <p class="text-gray-700 mb-2"><strong>Challenge:</strong> {{ $result->challenge->name }}</p>
                        <p class="text-gray-700 mb-4"><strong>Result:</strong> {{ $result->result }}</p>
                        <!-- Video URL Display -->
                        @if ($result->result)
                            <p class="text-gray-700 mb-4"><strong>Video URL:</strong>
                                <a href="{{ $result->result }}" class="text-blue-500 hover:text-blue-700" target="_blank" rel="noopener noreferrer">
                                    {{ $result->result }}
                                </a>
                            </p>
                        @else
                            <p class="text-gray-500 mb-4">No video URL provided.</p>
                        @endif
                        <!-- Approve Button -->
                        <form action="{{ route('admin.approveChallengeResult', $result->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success bg-green-600 text-white py-2 px-4 rounded-md">
                                Approve
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
