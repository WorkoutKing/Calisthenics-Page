@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Your Achievements') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h1 class="text-2xl font-bold text-blue-600 mb-6">Your Achievements</h1>
                <ul class="space-y-8">
                    @foreach ($achievements as $achievement)
                        <li class="p-6 bg-gray-50 rounded-lg shadow-md mb-6">
                            <h2 class="text-xl font-semibold text-gray-800">
                                Completed: {{ $achievement->element->name }} ({{ $achievement->completed_at->format('M d, Y') }})
                            </h2>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
