<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="relative">
            <x-input-label for="password" :value="__('Password')" class="text-gray-600 dark:text-gray-300" />

            <x-text-input id="password"
                        class="block mt-1 w-full bg-gray-800 text-white border border-gray-600 dark:bg-gray-700 dark:border-gray-500 dark:text-gray-300 pr-10"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />

            <!-- Eye Icon for Toggle -->
            <button type="button" onclick="togglePassword()"
                class="absolute inset-y-0 right-3 top-9 text-gray-400 dark:text-gray-300">
                <i id="eyeIcon" class="fas fa-eye"></i>
            </button>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 dark:text-red-400" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="block w-full text-center justify-center py-2 px-4 bg-black hover:bg-white text-white hover:text-black border border-white rounded-md shadow-sm">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
