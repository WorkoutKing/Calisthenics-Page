<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-800 dark:text-gray-200" />
            <x-text-input id="email"
                          class="block mt-1 w-full bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autofocus
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" class="text-gray-800 dark:text-gray-200" />

            <x-text-input id="password"
                        class="block mt-1 w-full bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 pr-10"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />

            <!-- Eye Icon for Toggle -->
            <button type="button" onclick="togglePassword()"
                class="absolute inset-y-0 right-3 top-9 text-gray-600 dark:text-gray-300">
                <i id="eyeIcon" class="fas fa-eye"></i>
            </button>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                       type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-600 dark:focus:ring-indigo-400"
                       name="remember">
                <span class="ms-2 text-sm text-gray-800 dark:text-gray-200">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Forgot Password Link -->
        <div class="mt-4 text-center">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Log In Button -->
        <div class="mt-6">
            <x-primary-button class="block w-full text-center justify-center py-2 px-4 bg-black hover:bg-white text-white hover:text-black border border-white rounded-md shadow-sm">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <br>
        <span class="block w-full text-center text-white">Dont have an account?</span>
        <!-- Register Button -->
        <div class="mt-4">
            <a href="{{ route('register') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-white hover:text-blue-600 block w-full text-center justify-center py-2 px-4 rounded-md shadow-sm">
                {{ __('Register') }}
            </a>
        </div>
    </form>
</x-guest-layout>
