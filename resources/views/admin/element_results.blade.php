@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Alerts Section -->
        <div class="space-y-4">
            @if ($errors->any())
                <div class="bg-red-800 border border-red-600 text-red-100 rounded-lg p-4">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-800 border border-green-600 text-green-100 rounded-lg p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-800 border border-yellow-600 text-yellow-100 rounded-lg p-4">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            @if (session('info'))
                <div class="bg-blue-800 border border-blue-600 text-blue-100 rounded-lg p-4">
                    <p>{{ session('info') }}</p>
                </div>
            @endif
        </div>

        <!-- Pending Element Results Section -->
        <div class="bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 text-gray-100">
                <h2 class="text-3xl font-semibold mb-6">Pending Element Results</h2>

                <!-- Results List -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($elementResults as $result)
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                            <!-- User and Details -->
                            <div class="mb-4">
                                <h5 class="text-lg font-semibold text-gray-200">User: {{ $result->user->name }}</h5>
                                <p class="text-gray-300">
                                    <strong>Element:</strong> {{ $result->step->element->name }}
                                </p>
                                <p class="text-gray-300">
                                    <strong>Progression:</strong> {{ $result->step->name }}
                                </p>
                                <p class="text-gray-300">
                                    <strong>Criteria:</strong> {{ $result->step->criteria }}
                                </p>
                                <p class="text-gray-300">
                                    <strong>Reps/Time:</strong> {{ $result->reps_time }}
                                </p>
                            </div>

                            <!-- Video URL -->
                            <div class="mb-4">
                                @if ($result->video_url)
                                    <p class="text-gray-300">
                                        <strong>Video URL:</strong>
                                        <a href="{{ $result->video_url }}" class="text-blue-400 hover:underline" target="_blank" rel="noopener noreferrer">
                                            {{ $result->video_url }}
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-500">No video URL provided.</p>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-between">
                                <form action="{{ route('admin.approveElementResult', $result->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.deleteElementResult', $result->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-8">
                    {{ $elementResults->links('pagination::tailwind') }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
