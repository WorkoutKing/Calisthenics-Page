@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4">
            @if ($errors->any())
                <div class="alert alert-danger mb-6 bg-red-800 border border-red-600 text-red-300 rounded-md p-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success mb-6 bg-green-800 border border-green-600 text-green-300 rounded-md p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning mb-6 bg-yellow-800 border border-yellow-600 text-yellow-300 rounded-md p-4">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info mb-6 bg-blue-800 border border-blue-600 text-blue-300 rounded-md p-4">
                    <p>{{ session('info') }}</p>
                </div>
            @endif
        </div>

        <div class="bg-gray-800 text-white p-4 sm:p-8 rounded-lg shadow-xl">
            <h1 class="text-3xl font-semibold text-gray-100 mb-6">Exercise Library</h1>

            <a href="{{ route('admin.exercises.create') }}" class="btn-extra text-white px-6 py-2 rounded-lg shadow-md transition duration-300 mb-4 inline-block">Add New Exercise</a>

            <!-- Search Form -->
            <div class="mb-6">
                <form action="{{ route('admin.exercises.index') }}" method="GET"
                    class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 w-full">

                    <!-- Search Input & Button (Full width on mobile) -->
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 w-full">
                        <input type="text" name="search" value="{{ $search ?? '' }}"
                            placeholder="Search by title or description"
                            class="w-full sm:w-auto flex-grow px-4 py-2 rounded-lg bg-gray-700 text-gray-300">

                        <button type="submit"
                            class="btn-extra text-white px-4 py-2 rounded-lg transition w-full sm:w-auto">
                            Search
                        </button>
                    </div>
                </form>

                <!-- Search Results & Clear Button (New line, but in one row) -->
                @if(request('search'))
                    <div class="flex flex-row items-center justify-between bg-gray-900 p-3 rounded-lg mt-2">
                        <p class="text-gray-300 text-sm">Search results for: <span class="font-semibold">{{ request('search') }}</span></p>
                        <a href="{{ route('admin.exercises.index') }}"
                            class="btn-extra px-4 py-2 rounded-lg transition text-white bg-red-500 hover:bg-red-600">
                            Clear
                        </a>
                    </div>
                @endif
            </div>

            <!-- Exercises List -->
            <ul class="space-y-4">
                @if($exercises->isEmpty())
                    <div class="col-span-full bg-gray-900 p-4 sm:p-6 md:p-8 rounded-lg shadow-md text-center">
                        <p class="text-xl text-gray-400">No results found. Try searching something else.</p>
                    </div>
                @endif
                @foreach($exercises as $exercise)
                    <li class="image-gif-position bg-gray-700 p-4 rounded-lg shadow-sm hover:bg-gray-600 transition duration-300">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center">

                            <!-- Media URL or Main Picture (Left Side) -->
                            @if($exercise->media_first_frame && $exercise->media_url)
                                <div class="w-[135px] h-[116px] flex-shrink-0 rounded-lg overflow-hidden mb-4 sm:mb-0 sm:mr-4 relative">
                                    @if ($exercise->media_first_frame)
                                        <img src="{{ $exercise->media_first_frame }}" alt="Media for {{ $exercise->title }}" class="main-image">
                                    @endif
                                    @if ($exercise->media_url)
                                        <img src="{{ $exercise->media_url }}" alt="Media for {{ $exercise->title }}" class="media-image">
                                    @endif
                                </div>
                            @elseif ($exercise->media_first_frame && !$exercise->media_url)
                                <div class="w-[135px] h-[116px] flex-shrink-0 rounded-lg overflow-hidden mb-4 sm:mb-0 sm:mr-4">
                                    <img src="{{ $exercise->media_first_frame }}" alt="Media for {{ $exercise->title }}" class="w-full h-full object-cover">
                                </div>
                            @endif

                            <!-- Textual Content (Right Side) -->
                            <div class="flex-1">
                                <a href="{{ route('admin.exercises.show', $exercise->id) }}" class="text-xl text-white font-semibold hover:underline">{{ $exercise->title }}</a>

                                <div class="text-gray-200 mt-2">
                                    <strong>Primary Muscle Group:</strong> {{ $exercise->primaryMuscleGroup->name ?? 'N/A' }}
                                </div>
                                <div class="text-xs sm:text-sm text-gray-400">
                                    <strong>Secondary Muscle Groups:</strong>
                                    @if ($exercise->secondaryMuscleGroups->count() > 0)
                                        {{ implode(', ', $exercise->secondaryMuscleGroups->pluck('name')->toArray()) }}
                                    @else
                                        N/A
                                    @endif
                                </div>

                                <div class="space-x-4 mt-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.exercises.edit', $exercise->id) }}" class="text-blue-400 hover:text-blue-300">Edit</a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.exercises.destroy', $exercise->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $exercises->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
@endsection
