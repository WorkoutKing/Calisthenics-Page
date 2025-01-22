@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Alerts Section -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 rounded-md p-4">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 rounded-md p-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-md p-4">
                <p>{{ session('warning') }}</p>
            </div>
        @endif

        @if (session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 rounded-md p-4">
                <p>{{ session('info') }}</p>
            </div>
        @endif

        <!-- Pending Challenge Results Section -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 text-gray-900">
                <h2 class="text-3xl font-semibold mb-6">Pending Challenge Results</h2>

                <!-- Results List -->
                <div class="space-y-6">
                    @foreach ($challengeResults as $result)
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                            <!-- User and Challenge Info -->
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                                <div>
                                    <h5 class="text-xl font-medium text-gray-800 mb-1">
                                        User: {{ $result->user->name }}
                                    </h5>
                                    <p class="text-gray-700"><strong>Challenge:</strong> {{ $result->challenge->name }}</p>
                                </div>
                                <!-- Video URL -->
                                <div class="mt-4 md:mt-0">
                                    @if ($result->result)
                                        <p class="text-gray-700">
                                            <strong>Video URL:</strong>
                                            <a href="{{ $result->result }}" class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">
                                                {{ $result->result }}
                                            </a>
                                        </p>
                                    @else
                                        <p class="text-gray-500">No video URL provided.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 flex space-x-4">
                                <form action="{{ route('admin.approveChallengeResult', $result->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md shadow hover:bg-green-700 transition">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.deleteChallengeResult', $result->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md shadow hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-8">
                    {{ $challengeResults->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
