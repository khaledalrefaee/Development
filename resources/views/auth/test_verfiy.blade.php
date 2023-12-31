<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    </div>

    <form method="POST" action="{{ route('verify.store') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('code')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="text"
                            name="code"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
