@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h2 class="text-3xl font-semibold mb-6">Your Notifications</h2>

        @if ($notifications->isEmpty())
            <p>No new notifications.</p>
        @else
            <ul>
                @foreach ($notifications as $notification)
                    <li class="p-4 mb-4 bg-gray-100 rounded-lg">
                        <p class="text-lg">{{ $notification->message }}</p>
                        <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                        <form action="{{ route('user.markAsRead', $notification->id) }}" method="POST" class="inline-block">
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
