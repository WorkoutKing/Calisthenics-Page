@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 sm:px-8 py-12">
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-xl">
            <h1 class="text-3xl font-semibold mb-6">Edit Muscle Group</h1>

            <form action="{{ route('admin.muscle_groups.update', $muscleGroup->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium">Name:</label>
                    <input type="text" name="name" value="{{ $muscleGroup->name }}" class="w-full px-4 py-2 mt-2 border rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-600 transition duration-300">
                    Update Muscle Group
                </button>
            </form>
        </div>
    </div>
@endsection
