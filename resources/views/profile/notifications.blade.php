@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Notifications') }}
    </h2>
@endsection

@section('content')
    <div class="p-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if ($errors->any())
                <div class="alert alert-danger mb-6 bg-red-100 dark:bg-red-900 border border-red-400 text-red-700 dark:border-red-600 text-red-700 dark:text-red-300 rounded-md p-4">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success mb-6 bg-green-100 dark:bg-green-900 border border-green-400 text-green-700 dark:border-green-600 text-green-700 dark:text-green-300 rounded-md p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Notifications Header -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Notifications</h1>
                    <div class="flex gap-2">
                        <!-- Mark All as Read Button -->
                        <form action="{{ route('profile.markAsRead') }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                @if ($notifications->where('read', 0)->isEmpty()) disabled @endif>
                                Mark All as Read
                            </button>
                        </form>

                        <!-- Clear All Notifications Button -->
                        <form action="{{ route('profile.clearNotifications') }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                @if ($notifications->isEmpty()) disabled @endif>
                                Clear All Notifications
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Notifications List -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                @if ($notifications->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400 text-center">You have no notifications at this time.</p>
                @else
                    <ul class="space-y-4">
                        @foreach ($notifications as $notification)
                            <li class="p-4 rounded-lg shadow border
                                {{ $notification->read ? 'bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600' : 'bg-yellow-50 dark:bg-yellow-900 border-yellow-400 dark:border-yellow-600' }}">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <!-- Notification Message -->
                                    <p class="text-gray-800 dark:text-gray-200 flex-1">
                                        @if (isset($notification->data['url']))
                                            <a href="{{ $notification->data['url'] }}" class="color-white hover:underline">
                                                {{ $notification->data['message'] }}
                                            </a>
                                        @else
                                            {{ $notification->data['message'] }}
                                        @endif
                                    </p>

                                    <!-- Read/Unread Status -->
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-1 text-sm font-semibold rounded
                                            {{ $notification->read ? 'bg-green-200 dark:bg-green-700 text-green-800 dark:text-green-300' : 'bg-red-200 dark:bg-red-700 text-red-800 dark:text-red-300' }}">
                                            {{ $notification->read ? 'Read' : 'Unread' }}
                                        </span>

                                        <!-- Mark as Read Button -->
                                        @if (!$notification->read)
                                            <form action="{{ route('profile.markAsReadSingle', $notification->id) }}" method="POST" class="mt-2 sm:mt-0">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                                    Mark as Read
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-8">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
