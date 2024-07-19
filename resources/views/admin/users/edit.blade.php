<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('users.update', $user) }}" class="">
                        @csrf
                        @method('put')
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                required autofocus autocomplete="name" :value="$user->name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="block w-full mt-1"
                                required autocomplete="email" :value="$user->email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="password" :value="__('New Password')" />
                            <x-text-input id="password" name="password" type="password" class="block w-full mt-1"
                                autocomplete="new-password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            <small class="text-gray-500">{{ __('Leave blank to keep current password') }}</small>
                        </div>
                        <div class="mb-6">
                            <x-input-label for="is_admin" :value="__('Role')" />
                            <x-select id="is_admin" name="is_admin" class="block w-full mt-1">
                                <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>Customer</option>
                                <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('is_admin')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('users.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
