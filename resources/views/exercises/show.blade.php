@extends('layouts.app')

@section('meta_title', $exercise->seo_title ?? $exercise->title)
@section('meta_description', $exercise->seo_description ?? Str::limit($exercise->content, 160))
@section('meta_keywords', $exercise->seo_keywords ?? '')

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
        </div>

        <div class="bg-gray-800 text-white p-4 sm:p-8 rounded-lg shadow-xl">
            <h1 class="text-3xl lg:text-4xl font-bold mb-4 text-center">{{ $exercise->title }}</h1>

            <!-- Display Main Picture -->
            @if ($exercise->media_url)
                <div class="mb-6 flex justify-center">
                    <img src="{{ $exercise->media_url }}" alt="Media for {{ $exercise->title }}" class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
            @elseif ($exercise->media_first_frame)
                <div class="mb-6 flex justify-center">
                    <img src="{{ $exercise->media_first_frame }}" alt="Media for {{ $exercise->title }}" class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
            @endif

            <!-- Primary Muscle Group -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-200">Primary Muscle Group</h2>
                <p class="text-gray-300">{{ $exercise->primaryMuscleGroup->name }}</p>
            </div>

            <!-- Secondary Muscle Groups -->
            @if ($exercise->secondaryMuscleGroups->count() > 0)
                <div class="mb-6">
                    <h2 class="text-1xl font-semibold text-gray-300">Secondary Muscle Groups</h2>
                    <div class="text-xs sm:text-sm text-gray-400">
                        <strong>Secondary Muscle Groups:</strong>
                        @if ($exercise->secondaryMuscleGroups->count() > 0)
                            {{ implode(', ', $exercise->secondaryMuscleGroups->pluck('name')->toArray()) }}
                        @else
                            N/A
                        @endif
                    </div>
                </div>
            @endif

            <!-- Description -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-200">Description</h2>
                <div class="change-format" id="editor">{!! $exercise->description !!}</div>
            </div>

            <div class="support-section text-center mt-8 bg-gray-900 p-2 sm:p-4 rounded-lg mb-4">
                <strong class="text-gray-300 text-xl font-semibold">Enjoying the exercises? Support my work!</strong>

                <div class="donation-buttons flex justify-center gap-6 mt-4">
                    <form action="https://www.paypal.com/donate" method="post" target="_top">
                        <input type="hidden" name="hosted_button_id" value="Q7NBP8DLC34N4" />
                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                        <img alt="" border="0" src="https://www.paypal.com/en_LT/i/scr/pixel.gif" width="1" height="1" />
                    </form>
                </div>
            </div>

            <!-- Back to Exercises Link -->
            <a href="{{ route('exercises.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700 transition duration-300">Back to Exercise Library</a>
        </div>
    </div>
@endsection
