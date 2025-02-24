@extends('layouts.app')

@section('meta_title', $post->seo_title ?? $post->title)
@section('meta_description', $post->seo_description ?? Str::limit($post->content, 160))
@section('meta_keywords', $post->seo_keywords ?? '')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Post Content -->
        <div class="bg-gray-800 text-white p-4 sm:p-8 rounded-lg shadow-xl">
            <!-- Post Title -->
            <h1 class="text-3xl font-bold text-gray-200 mb-4 text-left">{{ $post->title }}</h1>

            <!-- Post Image (centered) -->
            <div class="mb-6">
                <img src="{{ $post->main_picture ? asset('storage/' . $post->main_picture) : asset('images/default-post.jpg') }}"
                        alt="{{ $post->title }}"
                        class="w-full max-w-md mx-auto h-auto object-cover rounded-lg shadow-md">
            </div>

            <!-- Post Content (Full width) -->
            <div class="text-lg text-gray-300 leading-relaxed mb-4 change-format">{!! $post->content !!}</div>

            <!-- Date Information -->
            <div class="text-sm text-gray-500 mb-4">
                @if ($post->created_at != $post->updated_at)
                    <p>Post Created: {{ $post->created_at->format('F j, Y, g:i a') }}</p>
                    <p>Post Updated: {{ $post->updated_at->format('F j, Y, g:i a') }}</p>
                @else
                    <p>Post Created: {{ $post->created_at->format('F j, Y, g:i a') }}</p>
                @endif
            </div>

            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ url()->previous() }}" class="inline-flex items-center btn-extra py-2 px-4 rounded-lg shadow-md transition-all">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </div>
@endsection
