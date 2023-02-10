<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.index') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label class="mt-2" for="name" :value="__('Name:')" />
                            <x-text-input class="mt-2 p-1 border border-2 w-1/2" id="name " name="name"
                                value="" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="email" :value="__('Email:')" />
                            <x-text-input class="mt-2 p-1 border border-2 w-1/2" id="email" name="email"
                                value="" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="password" :value="__('Password:')" />
                            <x-text-input type="password" class="mt-2 p-1 border border-2 w-1/2" id="password"
                                name="password" value="" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="address" :value="__('Confirm Password:')" />
                            <x-text-input type="password" class="mt-2 p-1 border border-2 w-1/2"
                                id="password_confirmation" name="password_confirmation" value="" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <x-primary-button class="mt-4">
                            {{ __('Create') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
