<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center">
            <!-- Footer Links for Desktop -->
            <div class="flex space-x-8">
                <a href="{{ route('profile.index') }}" class="text-gray-500 hover:text-gray-700">
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('elements.index') }}" class="text-gray-500 hover:text-gray-700">
                    {{ __('Elements') }}
                </a>
                <a href="{{ route('challenges.index') }}" class="text-gray-500 hover:text-gray-700">
                    {{ __('Challenges') }}
                </a>
                <!-- Additional links like Privacy, Terms, etc. -->
                <a href="/privacy" class="text-gray-500 hover:text-gray-700">
                    {{ __('Privacy Policy') }}
                </a>
                <a href="/terms" class="text-gray-500 hover:text-gray-700">
                    {{ __('Terms of Service') }}
                </a>
            </div>

            <!-- Contact Info -->
            <div class="text-gray-500">
                <p>&copy; {{ date('Y') }} Madstars. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Responsive Footer Menu -->
    <div class="sm:hidden">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('profile.index') }}" class="block text-gray-500 hover:text-gray-700">
                {{ __('Profile') }}
            </a>
            <a href="{{ route('elements.index') }}" class="block text-gray-500 hover:text-gray-700">
                {{ __('Elements') }}
            </a>
            <a href="{{ route('challenges.index') }}" class="block text-gray-500 hover:text-gray-700">
                {{ __('Challenges') }}
            </a>
            <a href="/privacy" class="block text-gray-500 hover:text-gray-700">
                {{ __('Privacy Policy') }}
            </a>
            <a href="/terms" class="block text-gray-500 hover:text-gray-700">
                {{ __('Terms of Service') }}
            </a>
            <p class="text-gray-500 mt-4">&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</footer>
