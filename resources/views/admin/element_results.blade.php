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
        <!-- Pending Element Results Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-3xl font-semibold mb-6">Pending Element Results</h2>

                @foreach ($elementResults as $result)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
                        <h5 class="text-xl font-medium text-gray-800 mb-2">User: {{ $result->user->name }}</h5>
                        <p class="text-gray-700 mb-2"><strong>Element:</strong> {{ $result->step->element->name }}</p>
                        <p class="text-gray-700 mb-2"><strong>Result repetitions or time:</strong> {{ $result->reps_time }} </p>

                        <!-- Video URL Display -->
                        @if ($result->video_url)
                            <p class="text-gray-700 mb-4"><strong>Video URL:</strong>
                                <a href="{{ $result->video_url }}" class="text-blue-500 hover:text-blue-700" target="_blank" rel="noopener noreferrer">
                                    {{ $result->video_url }}
                                </a>
                            </p>
                        @else
                            <p class="text-gray-500 mb-4">No video URL provided.</p>
                        @endif

                        <!-- Approve Button -->
                        <form action="{{ route('admin.approveElementResult', $result->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">
                                Approve
                            </button>
                        </form>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.deleteElementResult', $result->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
