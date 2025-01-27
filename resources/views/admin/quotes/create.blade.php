@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 sm:px-8 py-12">
        <!-- Create New Quote Card Section -->
        <div class="bg-gray-800 p-8 rounded-lg shadow-xl">

            <h1 class="text-3xl font-semibold text-white mb-6">Create New Quote</h1>

            <!-- Alerts Section -->
            @if ($errors->any())
                <div class="bg-red-700 border border-red-600 text-red-100 rounded-lg p-4 mb-4">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Section -->
            <form action="{{ route('admin.quotes.store') }}" method="POST">
                @csrf

                <!-- Quote Field -->
                <div class="mb-6">
                    <label for="quote" class="block text-sm font-medium text-gray-300">Quote</label>
                    <textarea name="quote" id="quote" class="block w-full px-4 py-2 border bg-gray-700 text-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required>{{ old('quote') }}</textarea>
                </div>

                <!-- Author Field -->
                <div class="mb-6">
                    <label for="author" class="block text-sm font-medium text-gray-300">Author (Optional)</label>
                    <input type="text" name="author" id="author" value="{{ old('author') }}" class="block w-full px-4 py-2 border bg-gray-700 text-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition duration-300">
                    Save Quote
                </button>
            </form>
        </div>
    </div>
@endsection
