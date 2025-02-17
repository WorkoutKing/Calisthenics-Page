<footer class="bg-gray-900 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Desktop Footer -->
        <div class="hidden sm:flex justify-between items-center">
            <!-- Links Section -->
            <div class="flex space-x-8">
                <a href="/privacy-policy" class="text-gray-400 hover:text-gray-200 transition duration-200">
                    {{ __('Privacy Policy') }}
                </a>
                <a href="/releases" class="text-gray-400 hover:text-gray-200 transition duration-200">
                    {{ __('Latest Releases') }}
                </a>
            </div>

            <!-- Contact Section -->
            <div class="text-gray-500">
                <p>&copy; {{ date('Y') }} Madstars. All rights reserved.</p>
            </div>
        </div>

        <!-- Mobile Footer -->
        <div class="sm:hidden">
            <div class="space-y-6">
                <!-- Logo or Brand Name -->
                <div class="flex justify-center">
                    <span class="text-xl font-semibold text-gray-200">Madstars</span>
                </div>

                <!-- Links Section (Stacked for Mobile) -->
                <div class="flex flex-col items-center space-y-4">
                    <a href="/privacy-policy" class="text-gray-400 hover:text-gray-200 transition duration-200">
                        {{ __('Privacy Policy') }}
                    </a>
                    <a href="/releases" class="text-gray-400 hover:text-gray-200 transition duration-200">
                        {{ __('Latest Releases') }}
                    </a>
                </div>

                <!-- Copyright Notice -->
                <div class="text-center">
                    <p class="text-gray-500">&copy; {{ date('Y') }} Madstars. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
