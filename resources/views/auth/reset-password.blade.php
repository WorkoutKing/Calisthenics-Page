<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-800 dark:text-gray-200" />
            <x-text-input id="email"
                          class="block mt-1 w-full bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400"
                          type="email"
                          name="email"
                          :value="old('email', $request->email)"
                          required
                          autofocus
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-800 dark:text-gray-200" />
            <x-text-input id="password"
                          class="block mt-1 w-full bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400"
                          type="password"
                          name="password"
                          required
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-800 dark:text-gray-200" />
            <x-text-input id="password_confirmation"
                          class="block mt-1 w-full bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400"
                          type="password"
                          name="password_confirmation"
                          required
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Reset Password Button -->
        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="block w-full text-center justify-center py-2 px-4 bg-black hover:bg-white text-white hover:text-black border border-white rounded-md shadow-sm">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
