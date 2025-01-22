@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Alerts Section -->
        <div class="space-y-4">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 rounded-lg p-4">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 rounded-lg p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg p-4">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            @if (session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 rounded-lg p-4">
                    <p>{{ session('info') }}</p>
                </div>
            @endif
        </div>

        <!-- Pending Basics Results Section -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 text-gray-900">
                <h2 class="text-3xl font-semibold mb-6">Pending Basics Results</h2>

                <!-- Results List -->
                <div class="space-y-6">
                    @foreach ($pendingBasics as $basic)
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                            <!-- Header: User and Status -->
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h5 class="text-xl font-medium text-gray-800">User: {{ $basic->user->name }}</h5>
                                    <p class="text-gray-700">
                                        <strong>Exercise:</strong> {{ $basic->exercise }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 text-sm font-medium rounded-full
                                    {{ $basic->approved ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                    {{ $basic->approved ? 'Approved' : 'Pending' }}
                                </span>
                            </div>

                            <!-- Video URL -->
                            <p class="text-gray-700 mb-4">
                                <strong>Video URL:</strong>
                                <a href="{{ $basic->video_url }}" class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">
                                    {{ $basic->video_url }}
                                </a>
                            </p>

                            <!-- Action Buttons -->
                            <div class="flex space-x-4">
                                <form action="{{ route('admin.basicsResultsApprove', $basic) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md shadow hover:bg-green-700 transition">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.basicsResultsDelete', $basic) }}" method="POST">
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

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $pendingBasics->links('pagination::tailwind') }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
