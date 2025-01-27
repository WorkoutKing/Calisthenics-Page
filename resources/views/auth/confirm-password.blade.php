<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-600 dark:text-gray-300" />

            <x-text-input id="password" class="block mt-1 w-full bg-gray-800 text-white border border-gray-600 dark:bg-gray-700 dark:border-gray-500 dark:text-gray-300"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 dark:text-red-400" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="block w-full text-center justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white dark:bg-indigo-500 dark:hover:bg-indigo-600 rounded-md shadow-sm">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
