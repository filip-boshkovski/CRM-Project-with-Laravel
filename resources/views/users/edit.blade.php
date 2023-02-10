<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update', [$user->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div>
                            <x-input-label class="mt-2" for="name" :value="__('Name:')" />
                            <x-text-input class="mt-2 p-1 border border-2 w-1/2" id="name" name="name"
                                value="{{ $user->name }}" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="email" :value="__('Email:')" />
                            <x-text-input type="email" class="mt-2 p-1 border border-2 w-1/2" id="email"
                                name="email" value="{{ $user->email }}" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="password" :value="__('Password:')" />
                            <x-text-input type="password" class="mt-2 p-1 border border-2 w-1/2" id="password"
                                name="password" value="" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="password_confirmation" :value="__('Password Confirmation:')" />
                            <x-text-input type="password" class="mt-2 p-1 border border-2 w-1/2"
                                id="password_confirmation" name="password_confirmation" value="" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <x-primary-button class="mt-4">
                            {{ __('Update') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
