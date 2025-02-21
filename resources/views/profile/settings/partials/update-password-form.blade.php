<section>
    <header>
        <h2 class="text-lg font-medium text-gray-200">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="relative">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-gray-200" />

            <x-text-input id="update_password_current_password"
                        name="current_password"
                        type="password"
                        class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 pr-10"
                        autocomplete="current-password" />

            <!-- Toggle Button -->
            <button type="button" onclick="togglePassword('update_password_current_password', 'eyeIconCurrent')"
                    class="absolute inset-y-0 right-3 top-9 text-gray-400">
                <i id="eyeIconCurrent" class="fas fa-eye"></i>
            </button>

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400" />
        </div>

        <!-- New Password -->
        <div class="relative mt-4">
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-gray-200" />

            <x-text-input id="update_password_password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 pr-10"
                        autocomplete="new-password" />

            <!-- Toggle Button -->
            <button type="button" onclick="togglePassword('update_password_password', 'eyeIconNew')"
                    class="absolute inset-y-0 right-3 top-9 text-gray-400">
                <i id="eyeIconNew" class="fas fa-eye"></i>
            </button>

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-gray-200" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center gap-4">
            <!-- Updated Button Style -->
            <button class="inline-flex items-center px-6 py-2 btn-extra text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-22">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
