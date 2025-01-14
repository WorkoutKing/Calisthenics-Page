<footer class="bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Desktop Footer -->
        <div class="hidden sm:flex justify-between items-center">
            <!-- Links Section -->
            <div class="flex space-x-8">
                <a href="{{ route('profile.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('elements.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    {{ __('Elements') }}
                </a>
                <a href="{{ route('challenges.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    {{ __('Challenges') }}
                </a>
                <a href="/privacy" class="text-gray-600 hover:text-gray-900 transition">
                    {{ __('Privacy Policy') }}
                </a>
                <a href="/terms" class="text-gray-600 hover:text-gray-900 transition">
                    {{ __('Terms of Service') }}
                </a>
            </div>

            <!-- Contact Section -->
            <div class="text-gray-600">
                <p>&copy; {{ date('Y') }} Madstars. All rights reserved.</p>
            </div>
        </div>

        <!-- Mobile Footer -->
        <div class="sm:hidden">
            <div class="space-y-4">
                <div class="flex justify-center">
                    <p class="text-gray-600 text-center">&copy; {{ date('Y') }} Madstars</p>
                </div>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <a href="{{ route('profile.index') }}" class="text-gray-600 hover:text-gray-900 transition block">
                        {{ __('Profile') }}
                    </a>
                    <a href="{{ route('elements.index') }}" class="text-gray-600 hover:text-gray-900 transition block">
                        {{ __('Elements') }}
                    </a>
                    <a href="{{ route('challenges.index') }}" class="text-gray-600 hover:text-gray-900 transition block">
                        {{ __('Challenges') }}
                    </a>
                    <a href="/privacy" class="text-gray-600 hover:text-gray-900 transition block">
                        {{ __('Privacy Policy') }}
                    </a>
                    <a href="/terms" class="text-gray-600 hover:text-gray-900 transition block">
                        {{ __('Terms of Service') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
