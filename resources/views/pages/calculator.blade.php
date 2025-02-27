@extends('layouts.app')

@section('meta_title', 'Weighted Pull-Up | Calisthenics')
@section('meta_description', 'Calculate your one-rep max (1RM) for weighted pull-ups and dips using your body weight, added weight, and reps performed.')
@section('meta_keywords', 'weighted pull-up, weighted dips, 1RM calculator, calisthenics strength, fitness calculator')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Title -->
        <div class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 text-white p-3 rounded-lg shadow-lg mb-8">
            <h1 class="text-3xl lg:text-4xl font-bold text-center mb-4">Weighted Pull-Up</h1>
            <p class="text-center text-lg lg:text-xl">Enter your details to estimate your one-rep max (1RM) for weighted pull-ups.</p>
        </div>

        <!-- Weighted Pull-Up Calculator -->
        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-xl mb-8">
            <h2 class="text-2xl font-semibold text-gray-100 mb-6">Weighted Pull-Up 1RM</h2>
            <div class="space-y-4">
                <label class="block text-lg">Body Weight (kg)</label>
                <input type="number" id="pullUpBodyWeight" class="w-full p-2 rounded text-black" placeholder="Enter your body weight">

                <label class="block text-lg">Added Weight (kg) (optional)</label>
                <input type="number" id="pullUpAddedWeight" class="w-full p-2 rounded text-black" placeholder="Enter added weight (optional)">

                <label class="block text-lg">Reps Performed</label>
                <input type="number" id="pullUpReps" class="w-full p-2 rounded text-black" placeholder="Enter reps performed">

                <button onclick="calculatePullUp1RM()" class="mt-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Calculate Pull-Up 1RM
                </button>

                <div class="mt-6 p-4 bg-gray-700 rounded-lg text-center">
                    <h3 class="text-xl font-semibold">Estimated Extra Weight 1RM</h3>
                    <p id="pullUpResult" class="text-2xl font-bold text-green-400 mt-2">-</p>
                </div>
            </div>
        </div>
    </div>

    <script>
    function calculatePullUp1RM() {
        let bodyWeight = parseFloat(document.getElementById('pullUpBodyWeight').value) || 0;
        let addedWeight = parseFloat(document.getElementById('pullUpAddedWeight').value) || 0;
        let reps = parseInt(document.getElementById('pullUpReps').value) || 1;

        if (reps <= 0) {
            document.getElementById('pullUpResult').innerText = 'Enter valid reps';
            return;
        }

        let totalWeight = bodyWeight + addedWeight;
        let estimated1RM = totalWeight * (1 + reps / 30);
        let result = estimated1RM - bodyWeight;

        document.getElementById('pullUpResult').innerText = result.toFixed(2) + ' kg';
    }
    </script>
@endsection
