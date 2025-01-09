@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Profile</h1>
            </div>
        @if ($notifications->isEmpty())
            <p>No new notifications.</p>
        @else
            <ul>
                @foreach ($notifications as $notification)
                    <li class="p-4 mb-4 bg-gray-100 rounded-lg">
                        <p class="text-lg">{{ $notification->message }}</p>
                        <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                        <form action="{{ route('profile.markAsRead', $notification->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm bg-blue-600 text-white hover:bg-blue-700 rounded-md mt-2">Mark as Read</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
        </div>
    </div>
@endsection
