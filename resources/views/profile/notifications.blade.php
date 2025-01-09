@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Notifications') }}
    </h2>
@endsection

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

            <!-- Profile Header Section -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Notifications</h1>
            </div>

            <!-- Notifications Section -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Notifications</h2>
                    <form action="{{ route('profile.markAsRead') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Mark All as Read
                        </button>
                    </form>
                </div>

                @if ($notifications->isEmpty())
                    <p class="text-gray-600">You have no notifications at this time.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($notifications as $notification)
                            <div class="p-4 rounded-lg shadow-md border
                                {{ $notification->read ? 'bg-gray-100 border-gray-300' : 'bg-yellow-50 border-yellow-400' }}">
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-800">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <span class="px-2 py-1 text-sm font-semibold rounded
                                        {{ $notification->read ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                        {{ $notification->read ? 'Read' : 'Unread' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
