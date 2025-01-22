@extends('layouts.app')

@section('meta_title', 'News | Calisthenics ')
@section('meta_description', 'Learn more about our company and our team. We are a group of passionate individuals who love calisthenics and want to share our knowledge with the world.')
@section('meta_keywords', 'calisthenics, news, blog, articles, team, company')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Page Title and Description -->
        <div class="bg-gradient-to-r from-blue-500 via-blue-400 to-blue-600 text-white p-6 rounded-lg shadow-lg mb-8">
            <h1 class="text-4xl font-bold text-center mb-4">Latest News & Updates</h1>
            <p class="text-center text-lg sm:text-xl">
                Stay up-to-date with the latest news, tips, and insights from the calisthenics community. Discover new techniques, inspiring stories, and much more.
            </p>
        </div>

        <!-- Posts Grid -->
        <div class="bg-white p-8 rounded-lg shadow-xl">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Explore Our Articles</h2>

            <!-- Grid Layout for Posts -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($posts as $post)
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-transform transform hover:scale-105 flex flex-col">
                        <!-- Post Image -->
                        <div class="mb-4 overflow-hidden rounded-lg">
                            <img src="{{ $post->main_picture ? asset('storage/' . $post->main_picture) : 'default-image.jpg' }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-48 object-cover">
                        </div>

                        <!-- Post Title -->
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 truncate">{{ $post->title }}</h3>

                        <!-- Post Excerpt -->
                        <p class="text-sm text-gray-600 flex-grow mb-4">
                            {{ Str::limit($post->content, 100, '...') }}
                        </p>

                        <!-- Read More Link -->
                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:text-blue-700 self-start font-semibold mt-auto">
                            Read More <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @empty
                    <p class="text-gray-600 text-center col-span-full">
                        No posts available at the moment. Please check back later!
                    </p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
