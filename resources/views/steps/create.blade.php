@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('Add Step for Element: ') }}{{ $element->name }}
    </h2>
@endsection

@section('content')
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-300">
                    <h1 class="text-xl sm:text-2xl font-bold mb-4">Create Step For Element: {{ $element->name }} </h1>

                    <form action="{{ route('steps.store', $element->id) }}" method="POST">
                        @csrf
                        <!-- Step Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-300">Step Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-white bg-gray-700" required>
                        </div>

                        <!-- Criteria -->
                        <div class="mb-4">
                            <label for="criteria" class="block text-sm font-medium text-gray-300">Criteria</label>
                            <textarea name="criteria" id="criteria" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-white bg-gray-700" required></textarea>
                        </div>

                        <!-- Points -->
                        <div class="mb-4">
                            <label for="points" class="block text-sm font-medium text-gray-300">Points</label>
                            <input type="number" name="points" id="points" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-white bg-gray-700" required>
                        </div>

                        <!-- Associated Exercise -->
                        <div class="mb-4">
                            <label for="exercise_id" class="block text-sm font-medium text-gray-300">
                                Associated Exercise:
                            </label>
                            <select name="exercise_id" id="exercise_id"
                                    class="block w-full px-4 py-2 border border-gray-600 rounded-lg shadow-sm
                                        focus:outline-none focus:ring-2 focus:ring-blue-500
                                        bg-gray-800 text-gray-300">
                                <option value="">-- Select an Exercise (Optional) --</option>
                                @foreach ($exercises as $exercise)
                                    <option value="{{ $exercise->id }}"
                                            {{ (isset($step) && $step->exercise_id == $exercise->id) ? 'selected' : '' }}>
                                        {{ $exercise->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-2 btn-extra text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">
                                Add Step
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
