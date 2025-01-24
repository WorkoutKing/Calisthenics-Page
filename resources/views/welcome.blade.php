@extends('layouts.app')

@section('meta_title', 'Welcome | Calisthenics')
@section('meta_description', 'Stay up-to-date with the latest news, blog articles, and team updates. Learn more about the company and the team behind the scenes.')
@section('meta_keywords', 'calisthenics, dashboard, news, blog, articles, team, company')

@section('content')
<div class="py-12" style="background-color: #000;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">

            <!-- Daily Motivation Section -->
            <div class="daily_motivation px-6 py-4 bg-gray-900 rounded-lg shadow">
                <span class="daily_motivation_head text-xl font-semibold text-gray-300">Daily Motivation</span>
                <div class="quote_daily mt-4">
                    <blockquote class="text-lg italic text-gray-400">
                        <p>"{{ $quote->quote }}"</p>
                        <footer class="mt-2 text-right text-sm text-gray-500">- {{ $quote->author }}</footer>
                    </blockquote>
                </div>
            </div>

            <!-- Active Challenges Section -->
            <div class="active_challenges mt-10 px-6">
                <span class="font-semibold text-2xl text-gray-300">Active Challenges</span>
                @auth
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-6">
                        @foreach ($challenges as $challenge)
                            <div class="challenge p-4 bg-gray-800 rounded-lg shadow">
                                <div class="challenge_name text-xl font-semibold text-gray-200">{{ $challenge->name }}</div>
                                <div class="challenge_description text-sm text-gray-400">
                                    {{ \Illuminate\Support\Str::limit($challenge->description, 100) }}
                                </div>
                                <a href="{{ route('challenges.show', $challenge->id) }}"
                                   class="mt-4 inline-block bg-gradient-to-r from-blue-500 to-blue-700 text-white text-center px-4 py-2 rounded-lg shadow hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-150 ease-in-out">
                                    View Challenge
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center mt-6">
                        <p class="text-lg text-gray-400">
                            Please <a href="{{ route('login') }}" class="text-blue-400 hover:underline">login</a> or
                            <a href="{{ route('register') }}" class="text-blue-400 hover:underline">register</a> to join active challenges.
                        </p>
                    </div>
                @endauth
            </div>

            <!-- Top 3 Challenges from Each Category -->
            <div class="top_3 mt-10 px-6">
                <span class="font-semibold text-2xl text-gray-300">Top 3 Challenges</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    @foreach (['pull ups', 'push ups', 'dips', 'pistol squats'] as $exercise)
                        <div class="top_exercise p-4 bg-gray-800 rounded-lg shadow">
                            <h3 class="font-semibold text-xl text-gray-200">Top 3 {{ ucfirst($exercise) }}</h3>
                            <ul class="mt-4 text-sm text-gray-400">
                                @foreach (${"top".ucfirst(str_replace(' ', '', $exercise))} as $index => $user)
                                    <li>{{ $index + 1 }}. {{ $user->user->name }} - {{ $user->reps }} reps</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Newest Posts Section with Slider -->
            <div class="newest_post_of_page mt-10 px-6">
                <span class="posts_h_heading text-2xl font-semibold text-gray-300">Newest Posts</span>
                <div class="all_newest_posts_h mt-6">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($newestPosts as $post)
                                <a href="{{ route('posts.show', $post->id) }}" class="swiper-slide block group">
                                    <div class="relative bg-gray-800 rounded-lg overflow-hidden shadow-md transition transform group-hover:scale-105">
                                        <img src="{{ asset('storage/'.$post->main_picture) }}"
                                            class="w-full h-48 object-cover" alt="{{ $post->title }}">
                                        <div class="p-4">
                                            <h5 class="text-lg font-semibold text-white truncate">
                                                {{ $post->title }}
                                            </h5>
                                            <p class="text-sm text-gray-400 mt-2 line-clamp-2">
                                                {{ \Illuminate\Support\Str::limit($post->content, 80) }}
                                            </p>
                                        </div>
                                        <div class="absolute inset-0 bg-transparent group-hover:bg-black group-hover:bg-opacity-25"></div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <!-- About Calisthenics Section -->
            <div class="about_cali_section mt-10 px-6 py-8 bg-gray-800 rounded-lg shadow">
                <span class="about_h_heading text-2xl font-semibold text-gray-300">About Calisthenics</span>
                <div class="about_us_info mt-4 text-gray-400">
                    <p>Calisthenics is a type of strength training using only your body weight. It’s a fun and engaging way to stay fit. Learn more about how we help people achieve their fitness goals and become the best versions of themselves.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<style>
.swiper-container.swiper-initialized.swiper-horizontal.swiper-backface-hidden {
    height: fit-content;
}
/* General body background and text colors */
body {
    background-color: #000;
    color: #f3f4f6;
}

/* Radial gradient mouse hover effect */
.challenge:hover {
    cursor: pointer;
    background: radial-gradient(circle at center, var(--color-cta-glow-effect, #3b82f6), transparent 50%);
}

/* Swiper slide customization */
.swiper-slide {
    background-color: #1f2937; /* Dark gray for posts */
    border-radius: 0.5rem;
    transition: transform 0.3s ease-in-out;
}

.swiper-slide:hover {
    transform: scale(1.05);
}

/* Pagination dots */
.swiper-pagination-bullet {
    background: #3b82f6; /* Blue color */
}

.swiper-pagination-bullet-active {
    background: #2563eb; /* Slightly darker blue for active dot */
}
</style>
