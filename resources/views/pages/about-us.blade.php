@extends('layouts.app')

@section('meta_title', 'About Us | Calisthenics')
@section('meta_description', 'Learn more about our mission, vision, and the passionate team behind our calisthenics community. Discover how we strive to inspire fitness enthusiasts worldwide.')
@section('meta_keywords', 'calisthenics, fitness, mission, community, goal, strength, health, team')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- About Section -->
        <div class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 text-white p-8 rounded-lg shadow-lg mb-8">
            <h1 class="text-4xl font-bold text-center mb-4">About Us</h1>
            <p class="text-center text-lg sm:text-xl">
                At Madstars, we are passionate about calisthenics and believe in the power of bodyweight exercises to build strength, flexibility, and endurance. Our mission is to empower individuals worldwide to embrace a fitness lifestyle and transform their health through calisthenics.
            </p>
        </div>

        <!-- Mission Section -->
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-xl mb-8">
            <h2 class="text-3xl font-semibold text-gray-100 mb-6">Our Mission</h2>
            <p class="text-lg text-gray-400 leading-relaxed">
                Our mission is simple: to make calisthenics accessible and enjoyable for everyone, regardless of age or fitness level. We aim to provide high-quality resources, tutorials, and workout plans that help people build strength, improve flexibility, and enhance endurance without the need for fancy equipment or gym memberships.
            </p>
        </div>

        <!-- Goal Section -->
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-xl mb-8">
            <h2 class="text-3xl font-semibold text-gray-100 mb-6">Our Goal</h2>
            <p class="text-lg text-gray-400 leading-relaxed">
                Our goal is to foster a community of passionate fitness enthusiasts who support and inspire one another in their calisthenics journey. We believe in the power of consistency and dedication, and we’re here to help you push your limits and achieve your fitness goals. Whether you're a beginner or an advanced practitioner, we're committed to providing guidance and motivation every step of the way.
            </p>
        </div>

        <!-- Vision Section -->
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-xl mb-8">
            <h2 class="text-3xl font-semibold text-gray-100 mb-6">Our Vision</h2>
            <p class="text-lg text-gray-400 leading-relaxed">
                We envision a world where everyone can experience the benefits of calisthenics, living healthier, stronger, and more confident lives. We aim to become a global hub for calisthenics education and inspiration, providing a platform where people can share their progress, learn new techniques, and achieve personal milestones together.
            </p>
        </div>

        <!-- Founder Section -->
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-xl mb-8">
            <h2 class="text-3xl font-semibold text-gray-100 mb-6">Our Founder</h2>
            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('storage/pagePictures/fl.jpg') }}" alt="Raimundas" class="w-48 h-48 rounded-full mb-4">
                <h3 class="text-2xl font-semibold text-white">Raimundas</h3>
                <p class="text-sm text-gray-400">Founder & Head Coach</p>
            </div>
            <p class="text-lg text-gray-400 leading-relaxed text-center">
                Hi, I’m Raimundas, the founder of Madstars. I’ve been passionate about calisthenics for over 10 years and it’s become my way of life. As a web developer by profession, I combine my love for fitness with my technical skills to create this platform and help others achieve their fitness goals. I truly believe that with the right dedication, anyone can reach their full potential through calisthenics. My journey has been a mix of passion, discipline, and constant growth, and I hope to inspire others to follow the same path.
            </p>
        </div>

        <!-- Team Section -->
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-xl mb-8">
            <h2 class="text-3xl font-semibold text-gray-100 mb-6">Our Team</h2>
            <p class="text-lg text-gray-400 mb-4">
                Meet the passionate team behind Madstars. We are a diverse group of fitness enthusiasts, trainers, and experts who are committed to helping you on your calisthenics journey. With over 10 years of experience, we share a common vision of improving fitness and well-being through bodyweight exercises.
            </p>

            <!-- Grid Layout for Team Members -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Member 1 -->
                <div class="flex flex-col items-center bg-gray-700 p-6 rounded-lg shadow-sm mb-4 sm:mb-0">
                    <img src="#!" alt="Team Member 1" class="w-24 h-24 rounded-full mb-4">
                    <h3 class="text-lg font-semibold text-white">John Doe</h3>
                    <p class="text-sm text-gray-400">Lead Trainer</p>
                    <p class="text-center text-gray-400 text-sm mt-2">
                        John has been training for over 8 years, specializing in strength training and mobility. Hes passionate about guiding others to achieve their fitness goals.
                    </p>
                </div>

                <!-- Member 2 -->
                <div class="flex flex-col items-center bg-gray-700 p-6 rounded-lg shadow-sm mb-4 sm:mb-0">
                    <img src="#!" alt="Team Member 2" class="w-24 h-24 rounded-full mb-4">
                    <h3 class="text-lg font-semibold text-white">Jane Smith</h3>
                    <p class="text-sm text-gray-400">Nutrition Expert</p>
                    <p class="text-center text-gray-400 text-sm mt-2">
                        Jane helps our members with tailored nutrition advice, ensuring that their diet supports their fitness goals effectively.
                    </p>
                </div>

                <!-- Member 3 -->
                <div class="flex flex-col items-center bg-gray-700 p-6 rounded-lg shadow-sm mb-4 sm:mb-0">
                    <img src="#!" alt="Team Member 3" class="w-24 h-24 rounded-full mb-4">
                    <h3 class="text-lg font-semibold text-white">Emily Adams</h3>
                    <p class="text-sm text-gray-400">Mental Coach</p>
                    <p class="text-center text-gray-400 text-sm mt-2">
                        Emily supports members in maintaining a positive mindset and motivation through their calisthenics journey, focusing on goal setting and overcoming obstacles.
                    </p>
                </div>
            </div>
        </div>

        <!-- Funny Calisthenics Facts -->
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-xl mb-8">
            <h2 class="text-3xl font-semibold text-gray-100 mb-6">Funny Calisthenics Facts</h2>
            <ul class="list-disc pl-8 text-lg text-gray-400 space-y-4">
                <li>Did you know? The world record for the most push-ups in one go is over 5000! Talk about endurance!</li>
                <li>Calisthenics originated in ancient Greece! They didn’t have fancy gym equipment, just bodyweight exercises.</li>
                <li>Some people say doing handstands makes you feel like a superhero. Well, we say it’s because you *are* a superhero!</li>
                <li>Did you know that a burpee is essentially a combination of a squat, push-up, and jump? That’s like three exercises in one! (But, don’t worry, no one said you can’t hate burpees!)</li>
                <li>Ever wondered why your body feels sore after a workout? That’s because calisthenics actually strengthens and stretches your muscles simultaneously! Double the gains!</li>
            </ul>
        </div>

        <!-- Contact Section (optional) -->
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-xl mb-8">
            <h2 class="text-3xl font-semibold text-gray-100 mb-6">Contact Us</h2>
            <p class="text-lg text-gray-400 mb-4">
                Have questions or want to learn more about calisthenics? Feel free to reach out to us anytime! We’d love to connect and assist you on your fitness journey.
            </p>
            <a href="mailto:madstars4ever@gmail.com" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Contact Us</a>
        </div>
    </div>
@endsection
