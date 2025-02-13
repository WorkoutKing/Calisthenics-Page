@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 sm:px-8">
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
            <h1 class="text-3xl font-semibold text-gray-100 mb-6">Muscle Groups</h1>

            <a href="{{ route('admin.muscle_groups.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300 mb-4 inline-block">
                Add New Muscle Group
            </a>

            <ul class="space-y-4">
                @foreach($muscleGroups as $group)
                    <li class="bg-gray-700 p-4 rounded-lg shadow-sm flex justify-between items-center">
                        <span class="text-white text-lg">{{ $group->name }}</span>

                        <div class="space-x-4">
                            <a href="{{ route('admin.muscle_groups.edit', $group->id) }}" class="text-yellow-500 hover:text-yellow-700 font-semibold transition duration-200">
                                Edit
                            </a>

                            <form action="{{ route('admin.muscle_groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-semibold transition duration-200" onclick="return confirm('Are you sure you want to delete this group?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
