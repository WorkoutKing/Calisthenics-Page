<!-- resources/views/workouts/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8" x-data="workoutForm()">
        <div class="space-y-4">
            @if ($errors->any())
                <div class="bg-red-700 border border-red-600 text-red-100 rounded-lg p-4">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-700 border border-red-600 text-red-100 rounded-lg p-4">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-700 border border-green-600 text-green-100 rounded-lg p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-700 border border-yellow-600 text-yellow-100 rounded-lg p-4">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            @if (session('info'))
                <div class="bg-blue-700 border border-blue-600 text-blue-100 rounded-lg p-4">
                    <p>{{ session('info') }}</p>
                </div>
            @endif
        </div>
        <h1 class="text-3xl font-semibold text-gray-100 mb-6">Create Workout</h1>

        <form action="{{ route('workouts.store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-400 mb-1">Title</label>
                <input type="text" name="title" class="w-full px-4 py-2 rounded-lg bg-gray-700 border-none text-gray-300" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-400 mb-1">Workout Type</label>
                <input type="text" name="workout_type" class="w-full px-4 py-2 rounded-lg bg-gray-700 border-none text-gray-300" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-400 mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 rounded-lg bg-gray-700 border-none text-gray-300" required></textarea>
            </div>

            <div class="mb-4">
                <label for="focus" class="block text-gray-400 mb-1">Focus (Optional)</label>
                <select name="focus" id="focus" class="w-full px-4 py-2 rounded-lg bg-gray-700 border-none text-gray-300">
                    <option value="">Select Focus</option> <!-- Optional default value -->
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>

            <!-- Select Exercise -->
            <div class="mb-4">
                <label class="block text-gray-400 mb-1">Select Exercise</label>
                <div class="flex items-center space-x-4">
                    <select x-model="selectedExercise" class="w-full px-4 py-2 rounded-lg bg-gray-700 border-none text-gray-300">
                        <option value="">-- Select an Exercise --</option>
                        @foreach($exercises as $exercise)
                            <option value="{{ $exercise->id }}">{{ $exercise->title }}</option>
                        @endforeach
                    </select>
                    <button type="button" @click="addExercise()" class="btn-extra text-white px-4 py-2 rounded-lg transition">+</button>
                </div>
            </div>

            <!-- Dynamic Exercise List -->
            <template x-for="(exercise, index) in exercises" :key="index">
                <div class="mb-4 bg-gray-700 p-4 rounded-lg">
                    <input type="hidden" :name="'exercises['+index+'][id]'" :value="exercise.id">

                    <h3 class="text-xl text-white mb-2" x-text="exercise.title"></h3>

                    <div class="flex flex-wrap items-center gap-2">
                        <!-- Hidden inputs for sets, reps, rest time, and note -->
                        <input type="hidden" :name="'exercises['+index+'][sets]'" x-model="exercise.sets">
                        <input type="hidden" :name="'exercises['+index+'][reps]'" x-model="exercise.reps">
                        <input type="hidden" :name="'exercises['+index+'][rest_time]'" x-model="exercise.rest_time">
                        <input type="hidden" :name="'exercises['+index+'][note]'" x-model="exercise.note">

                        <!-- Visible fields for inputting sets, reps, rest time, and note -->
                        <input type="number" x-model="exercise.sets" placeholder="Sets" class="w-20 px-2 py-1 rounded bg-gray-600 border-none text-gray-300" required>
                        <input type="number" x-model="exercise.reps" placeholder="Reps" class="w-20 px-2 py-1 rounded bg-gray-600 border-none text-gray-300" required>
                        <input type="number" x-model="exercise.rest_time" placeholder="Rest (sec)" class="w-28 px-2 py-1 rounded bg-gray-600 border-none text-gray-300" required>
                        <input type="text" x-model="exercise.note" placeholder="Note (optional)" class="w-40 px-2 py-1 rounded bg-gray-600 border-none text-gray-300">
                        <button type="button" @click="removeExercise(index)" class="text-red-400 hover:underline">Remove</button>
                    </div>
                </div>
            </template>

            @if (auth()->user()->role_id === 2)
                <div class="mb-6">
                    <label for="seo_title" class="block text-sm font-medium text-gray-300">SEO Title:</label>
                    <input type="text" name="seo_title" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2">
                </div>

                <div class="mb-6">
                    <label for="seo_description" class="block text-sm font-medium text-gray-300">SEO Description:</label>
                    <textarea name="seo_description" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2"></textarea>
                </div>

                <div class="mb-6">
                    <label for="seo_keywords" class="block text-sm font-medium text-gray-300">SEO Keywords:</label>
                    <textarea name="seo_keywords" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2"></textarea>
                </div>
            @endif

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">Create Workout</button>
        </form>
    </div>

    <script>
        function workoutForm() {
            return {
                selectedExercise: '',
                exercises: [],
                addExercise() {
                    if (this.selectedExercise !== '') {
                        const exercise = @json($exercises).find(e => e.id == this.selectedExercise);
                        if (exercise && !this.exercises.some(e => e.id === exercise.id)) {
                            // Default values for sets, reps, rest time
                            this.exercises.push({
                                id: exercise.id,
                                title: exercise.title,
                                sets: 3,  // Default value for sets
                                reps: 10, // Default value for reps
                                rest_time: 60, // Default value for rest time (in seconds)
                                note: '' // Default empty note
                            });
                            this.selectedExercise = '';
                        }
                    }
                },
                removeExercise(index) {
                    this.exercises.splice(index, 1);
                }
            }
        }
    </script>
@endsection
