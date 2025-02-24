@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 p-3 sm:p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl lg:text-4xl font-bold text-center mb-4">Latest Releases</h1>

            <!-- Create Release Button for Admins -->
            @if (auth()->user())
                @if (auth()->user()->role_id == 2)
                    <div class="mb-8">
                        <a href="{{ route('releases.create') }}" class="block btn-extra text-white text-center px-6 py-3 rounded-lg shadow-md transition duration-300 w-full">
                            Create New Release
                        </a>
                    </div>
                @endif
            @endif

            @foreach ($releases as $release)
                <div class="mb-10 p-3 sm:p-6 rounded-lg bg-gray-700 shadow-md w-full">
                    <h2 class="text-xl font-semibold text-white">{{ $release->title }}</h2>
                    <p class="text-gray-400 text-sm">Released on: {{ $release->release_date }}</p>

                    @if ($release->image_url)
                        <img src="{{ $release->image_url }}" alt="Release Image" class="mt-4 rounded-lg w-full object-cover shadow-lg">
                    @endif

                    <div class="mt-4 text-gray-300 leading-relaxed change-format-releases">
                        {!! $release->description !!}
                    </div>

                    <!-- Edit Button for Admins -->
                    @if (auth()->user())
                        @if (auth()->user()->role_id == 2)
                            <div class="mt-6 flex space-x-4">
                                <!-- Edit Button -->
                                <a href="{{ route('releases.edit', $release->id) }}" class="block btn-extra text-white text-center px-6 py-3 rounded-lg shadow-md transition duration-300 w-full">
                                    Edit Release
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('releases.destroy', $release->id) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this release?');"
                                            class="block btn-extra-delete text-white text-center px-6 py-3 rounded-lg shadow-md transition duration-300 w-full">
                                        Delete Release
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
