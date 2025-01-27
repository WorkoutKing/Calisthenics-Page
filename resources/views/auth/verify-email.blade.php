<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <!-- Resend Verification Email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button class="block w-full text-center justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white dark:bg-indigo-500 dark:hover:bg-indigo-600 rounded-md shadow-sm">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Log Out -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
