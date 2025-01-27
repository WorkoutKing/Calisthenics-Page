@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success Alert -->
        @if (session('success'))
            <div class="bg-green-700 border border-green-600 text-green-100 rounded-lg p-4 mb-6">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Page Title and Add New Quote Button -->
        <div class="flex items-center justify-between mb-6 flex-col sm:flex-row">
            <h1 class="text-2xl sm:text-3xl font-semibold text-white mb-4 sm:mb-0">Manage Quotes</h1>
            <a href="{{ route('admin.quotes.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                Add New Quote
            </a>
        </div>

        <!-- Quotes List -->
        <div class="bg-gray-800 shadow-md rounded-lg p-6">
            <ul class="space-y-4">
                @foreach ($quotes as $quote)
                    <li class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 border-b border-gray-600">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center">
                            <strong class="text-xl font-semibold text-white mb-2 sm:mb-0">{{ $quote->quote }}</strong>
                            <span class="text-sm text-gray-400 ml-0 sm:ml-4">- {{ $quote->author }}</span>
                        </div>

                        <div class="flex space-x-4 mt-2 sm:mt-0">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.quotes.edit', $quote->id) }}" class="text-yellow-400 hover:text-yellow-500 font-semibold transition duration-200">
                                Edit
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('admin.quotes.destroy', $quote->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-500 font-semibold transition duration-200" onclick="return confirm('Are you sure you want to delete this quote?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $quotes->links() }}
        </div>
    </div>
@endsection
