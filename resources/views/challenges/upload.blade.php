@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload Your Results for {{ $challenge->name }}</h2>

    <form action="{{ route('challenges.complete', $challenge->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="result_details" class="form-label">Your Results</label>
            <textarea name="result_details" id="result_details" class="form-control" required></textarea>
        </div>
        <button type="submit" class="mt-4 inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:bg-blue-700">Submit</button>
    </form>
</div>
@endsection
