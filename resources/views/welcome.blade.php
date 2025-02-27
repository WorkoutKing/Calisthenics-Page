@extends('layouts.app')

@section('meta_title', 'Welcome | Calisthenics')
@section('meta_description', 'Stay up-to-date with the latest news, blog articles, and team updates. Learn more about the company and the team behind the scenes.')
@section('meta_keywords', 'calisthenics, dashboard, news, blog, articles, team, company')

@section('content')
<div class="p-4 welcome-bg">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <!-- Hero Section -->
            <div class="hero_section px-6 py-16 bg-cover bg-center rounded-lg shadow" style="background-image: url('https://static.vecteezy.com/system/resources/thumbnails/045/826/339/small/the-dark-stage-shows-dark-background-an-empty-dark-scene-neon-light-and-spotlights-the-concrete-floor-and-studio-room-with-smoke-float-up-the-interior-texture-high-quality-photo.jpg');">
                <div class="max-w-3xl mx-auto text-center">
                    @auth
                        <h1 class="text-4xl font-bold text-white">Have a good time, {{ Auth::user()->name }}!</h1>
                        <p class="mt-4 text-lg text-white">Continue your calisthenics journey and achieve new milestones.</p>
                        <a href="{{ route('profile.index') }}" class="btn btn-extra mt-8 inline-block px-8 py-3 text-white font-semibold rounded-lg transition duration-300">Go to Dashboard</a>
                    @endauth
                    @guest
                        <h1 class="text-4xl font-bold text-white">Transform Your Body with Calisthenics</h1>
                        <p class="mt-4 text-lg text-white">Join our community and start your journey to a healthier, stronger you.</p>
                        <a href="{{ route('login') }}" class="btn btn-extra mt-8 inline-block px-8 py-3 text-white font-semibold rounded-lg transition duration-300">Get Started</a>
                    @endguest
                </div>
            </div>

            <!-- Daily Motivation Section -->
            <div class="daily_motivation py-4 bg-gray-900 rounded-lg shadow mt-10 px-6 text-white">
                <span class="daily_motivation_head text-xl font-semibold text-gray-300">Daily Motivation</span>
                <div class="quote_daily mt-4">
                    <blockquote class="text-lg italic text-gray-400">
                        <p>"{{ $quote->quote }}"</p>
                        <footer class="mt-2 text-right text-sm text-gray-500">- {{ $quote->author }}</footer>
                    </blockquote>
                </div>
            </div>

            <!-- Learn & Achieve Section -->
            <div class="flex flex-col md:flex-row items-stretch gap-6 md:gap-10 mt-10">
                <div class="w-full md:w-1/2 bg-gray-800 p-6 rounded-lg shadow-md text-white flex flex-col justify-between min-h-full">
                    <h2 class="text-3xl font-bold flex items-center"><span class="mr-3">💻</span> Learn</h2>
                    <p class="mt-4 text-lg text-gray-400 flex-grow">Turn knowledge into power. The Cali Skills library contains all the information you need to excel in your bodyweight fitness journey.</p>
                </div>
                <div class="w-full md:w-1/2 bg-gray-800 p-6 rounded-lg shadow-md text-white flex flex-col justify-between min-h-full">
                    <h2 class="text-3xl font-bold flex items-center"><span class="mr-3">🏆</span> Achieve</h2>
                    <p class="mt-4 text-lg text-gray-400 flex-grow">Track your progress and achieve milestones through our progression roadmaps. Stay motivated and reach new heights!</p>
                </div>
            </div>

            <!-- Newest Posts Section with Slider -->
            <div class="swiper-container mt-10">
                <div class="swiper-wrapper">
                    @foreach ($newestPosts as $post)
                        <a href="{{ route('posts.show', $post->slug) }}" class="swiper-slide block group">
                            <div class="relative bg-gray-800 rounded-lg overflow-hidden shadow-md transition transform group-hover:scale-105">
                                <img src="{{ asset('storage/'.$post->main_picture) }}" class="w-full h-48 object-cover" alt="{{ $post->title }}">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-white">{{ $post->title }}</h5>
                                    <p class="text-sm text-gray-400 mt-2 line-clamp-2">{{ Str::limit(strip_tags($post->content), 100, '...') }}</p>
                                </div>
                                <div class="absolute inset-0 bg-transparent group-hover:bg-black group-hover:bg-opacity-25"></div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <!-- Navigation & Pagination Wrapper -->
                <div class="swiper-button-prev" aria-label="Swiper button prev"></div>
                <div class="swiper-button-next" aria-label="Swiper button next"></div>
            </div>
        </div>
    </div>
</div>
@endsection