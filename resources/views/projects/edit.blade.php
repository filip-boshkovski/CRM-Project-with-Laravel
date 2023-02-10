<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('projects', [$project->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div>
                            <x-input-label class="mt-2" for="title" :value="__('Title:')" />
                            <x-text-input class="mt-2 p-1 border border-2 w-1/2" id="title" name="title"
                                value="{{ $project->title }}" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="description" :value="__('Description:')" />
                            <textarea
                                class="w-1/2 border border-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="description" id="description" cols="40" rows="5">{{ $project->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="deadline" :value="__('Deadline:')" />
                            <x-text-input type="date" class="mt-2 p-1 border border-2 w-1/2" id="deadline"
                                name="deadline" value="{{ old('deadline', $project->deadline) }}" />
                            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="user_id" :value="__('Assigned User:')" />

                            <select
                                class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="user_id" id="user_id">
                                @foreach ($users as $id => $entry)
                                    <option value="{{ $id }}"
                                        {{ (old('user_id') ? old('user_id') : $project->user->id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $entry }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label class="mt-2" for="client_id" :value="__('Assigned Client:')" />
                            <select
                                class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="client_id" id="client_id">
                                @foreach ($clients as $id => $entry)
                                    <option value="{{ $id }}"
                                        {{ (old('client_id') ? old('client_id') : $project->client->id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $entry }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
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
