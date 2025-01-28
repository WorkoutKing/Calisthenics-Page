<footer class="bg-black border-t border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Desktop Footer -->
        <div class="hidden sm:flex justify-between items-center">
            <!-- Links Section -->
            <div class="flex space-x-8">
                <a href="/privacy-policy" class="text-gray-400 hover:text-white transition">
                    {{ __('Privacy Policy') }}
                </a>
                <a href="/terms" class="text-gray-400 hover:text-white transition">
                    {{ __('Terms of Service') }}
                </a>
            </div>

            <!-- Contact Section -->
            <div class="text-gray-400">
                <p>&copy; {{ date('Y') }} Madstars. All rights reserved.</p>
            </div>
        </div>

        <!-- Mobile Footer -->
        <div class="sm:hidden">
            <div class="space-y-4">
                <div class="flex justify-center">
                    <p class="text-gray-400 text-center">&copy; {{ date('Y') }} Madstars</p>
                </div>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <a href="/privacy-policy" class="text-gray-400 hover:text-white transition block">
                        {{ __('Privacy Policy') }}
                    </a>
                    <a href="/terms" class="text-gray-400 hover:text-white transition block">
                        {{ __('Terms of Service') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
