<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Client') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/clients" method="POST">
                        @csrf
                        <div>
                            <x-input-label class="mt-2" for="company" :value="__('Company:')" />
                            <x-text-input class="mt-2 p-1 border border-2 w-1/2" id="company" name="company"
                                value="" />
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="city" :value="__('City:')" />
                            <x-text-input class="mt-2 p-1 border border-2 w-1/2" id="city" name="city"
                                value="" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="VAT" :value="__('VAT:')" />
                            <x-text-input class="mt-2 p-1 border border-2 w-1/2" id="VAT" name="VAT"
                                value="" />
                            <x-input-error :messages="$errors->get('VAT')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="address" :value="__('Address:')" />
                            <x-text-input class="mt-2 p-1 border border-2 w-1/2" id="address" name="address"
                                value="" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
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
