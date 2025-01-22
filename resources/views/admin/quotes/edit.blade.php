@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 sm:px-8 py-12">
        <!-- Edit Quote Card Section -->
        <div class="bg-white p-8 rounded-lg shadow-xl">

            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Quote</h1>

            <!-- Alerts Section -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 rounded-lg p-4 mb-4">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Section -->
            <form action="{{ route('admin.quotes.update', $quote->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Quote Field -->
                <div class="mb-6">
                    <label for="quote" class="block text-sm font-medium text-gray-700">Quote</label>
                    <textarea name="quote" id="quote" class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required>{{ old('quote', $quote->quote) }}</textarea>
                </div>

                <!-- Author Field -->
                <div class="mb-6">
                    <label for="author" class="block text-sm font-medium text-gray-700">Author (Optional)</label>
                    <input type="text" name="author" id="author" value="{{ old('author', $quote->author) }}" class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-600 transition duration-300">
                    Update Quote
                </button>
            </form>
        </div>
    </div>
@endsection
