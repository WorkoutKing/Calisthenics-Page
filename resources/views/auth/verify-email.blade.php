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
                <x-primary-button class="block w-full text-center justify-center py-2 px-4 bg-black hover:bg-white text-white hover:text-black border border-white rounded-md shadow-sm">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Log Out -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="block w-full text-center justify-center py-2 px-4 bg-black hover:bg-white text-white hover:text-black border border-white rounded-md shadow-sm">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
