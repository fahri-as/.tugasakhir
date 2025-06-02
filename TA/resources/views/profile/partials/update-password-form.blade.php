<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div class="transform transition hover:-translate-y-1 duration-200">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="font-medium text-gray-700" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="transform transition hover:-translate-y-1 duration-200">
            <x-input-label for="update_password_password" :value="__('New Password')" class="font-medium text-gray-700" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="transform transition hover:-translate-y-1 duration-200">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="font-medium text-gray-700" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="bg-gradient-to-r from-blue-500 to-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md py-2 px-4 flex items-center">
                <i class="fas fa-lock mr-2"></i>
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 flex items-center"
                >
                    <i class="fas fa-check mr-1"></i>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
