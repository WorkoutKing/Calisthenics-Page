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
                    <!-- For Authenticated Users -->
                    @auth
                        <h1 class="text-4xl font-bold text-white">Welcome Back, {{ Auth::user()->name }}!</h1>
                        <p class="mt-4 text-lg text-gray-300">Continue your calisthenics journey and achieve new milestones.</p>
                        <a href="{{ route('profile.index') }}" class="mt-8 inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">Go to Dashboard</a>
                    @endauth

                    <!-- For Non-Authenticated Users -->
                    @guest
                        <h1 class="text-4xl font-bold text-white">Transform Your Body with Calisthenics</h1>
                        <p class="mt-4 text-lg text-gray-300">Join our community and start your journey to a healthier, stronger you.</p>
                        <a href="{{ route('login') }}" class="mt-8 inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">Get Started</a>
                    @endguest
                </div>
            </div>

            <!-- About Calisthenics Section -->
            <div class="about_cali_section mt-10 px-6 py-12 bg-gray-800 rounded-lg shadow-lg">
                <div class="max-w-7xl mx-auto">
                    <!-- Section Heading -->
                    <span class="about_h_heading text-3xl font-bold text-gray-300 text-center block mb-8">About Calisthenics & Our Mission</span>

                    <!-- Grid Layout for Content -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <!-- Left Side: Image or Illustration -->
                        <div class="about_image flex justify-center">
                            <img src="{{ asset('storage/pagePictures/ring.jpg') }}" alt="About Calisthenics" class="rounded-lg shadow-md w-full max-w-md h-auto object-cover">
                        </div>

                        <!-- Right Side: Content -->
                        <div class="about_content">
                            <!-- Introduction -->
                            <p class="text-lg text-gray-400 mb-6">
                                Calisthenics is more than just a workout—its a lifestyle. By using only your body weight, you can build strength, flexibility, and endurance while connecting with a global community of fitness enthusiasts.
                            </p>

                            <!-- Mission Statement -->
                            <div class="mission_statement bg-gray-700 p-6 rounded-lg mb-6">
                                <h3 class="text-xl font-semibold text-gray-200 mb-3">Our Mission</h3>
                                <p class="text-gray-400">
                                    We are dedicated to empowering individuals to achieve their fitness goals through calisthenics. Our platform provides the tools, resources, and community support needed to help you unlock your full potential.
                                </p>
                            </div>

                            <!-- Why Choose Us -->
                            <div class="why_choose_us">
                                <h3 class="text-xl font-semibold text-gray-200 mb-3">Why Choose Us?</h3>
                                <ul class="list-disc list-inside text-gray-400 space-y-2">
                                    <li>Expert-designed workout plans for all skill levels.</li>
                                    <li>A supportive and inclusive community.</li>
                                    <li>Access to exclusive challenges and events.</li>
                                    <li>Personalized progress tracking and analytics.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top 3 Challenges from Each Category -->
            <div class="top_3 mt-10">
                <span class="font-semibold text-2xl text-gray-300">Top 3 Challenges</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    @foreach (['pull ups', 'push ups', 'dips', 'pistol squats'] as $exercise)
                        <div class="top_exercise p-4 bg-gray-800 rounded-lg shadow">
                            <h3 class="font-semibold text-xl text-gray-200">Top 3 {{ ucfirst($exercise) }}</h3>
                            <ul class="mt-4 text-sm text-gray-400">
                                @foreach (${"top".ucfirst(str_replace(' ', '', $exercise))} as $index => $user)
                                    <li>{{ $index + 1 }}. <a href="/profile/{{ $user->user->id }}" class="font-bold">{{ Str::title($user->user->name) }}</a> - {{ $user->reps }} reps</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Daily Motivation Section -->
            <div class="daily_motivation py-4 bg-gray-900 rounded-lg shadow mt-10 px-6">
                <span class="daily_motivation_head text-xl font-semibold text-gray-300">Daily Motivation</span>
                <div class="quote_daily mt-4">
                    <blockquote class="text-lg italic text-gray-400">
                        <p>"{{ $quote->quote }}"</p>
                        <footer class="mt-2 text-right text-sm text-gray-500">- {{ $quote->author }}</footer>
                    </blockquote>
                </div>
            </div>

            <!-- Newest Posts Section with Slider -->
            <div class="newest_post_of_page mt-10">
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

            <!-- Social Media Feed Section -->
            {{--  <div class="social_media_feed mt-10 px-6 py-8 bg-gray-800 rounded-lg shadow">
                <span class="font-semibold text-2xl text-gray-300">Follow Us on Social Media</span>
                <div class="mt-6">
                    <!-- Instagram Feed -->
                    <div class="instagram_feed">
                        <!-- Embed Instagram feed here -->
                    </div>
                    <!-- Twitter Feed -->
                    <div class="twitter_feed mt-6">
                        <!-- Embed Twitter feed here -->
                    </div>
                </div>
            </div>  --}}

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
