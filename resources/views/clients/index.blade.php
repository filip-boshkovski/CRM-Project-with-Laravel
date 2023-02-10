<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients:') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    @can('create', \App\Models\Client::class)
                                        <div class="my-2">
                                            <x-primary-button>
                                                <a href="{{ route('clients.create') }}">Create Client</a>
                                            </x-primary-button>
                                            <x-primary-button>
                                                <a href="{{ url('clients?archive') }}">View Archived Clients</a>
                                            </x-primary-button>
                                        </div>
                                    @endcan
                                    <table class="min-w-full">
                                        <thead class="bg-gray-200 border-b">
                                            <tr>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    #
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Company
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    City
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    VAT
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Address
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $client)
                                                <tr
                                                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $client->id }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $client->company }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $client->city }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $client->VAT }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $client->address }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        @if ($client->trashed())
                                                            @can('restore', \App\Models\Client::class)
                                                                <form action="{{ route('clients.restore', $client->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <x-primary-button class="m-1">
                                                                        Restore
                                                                    </x-primary-button>
                                                                </form>
                                                            @endcan

                                                            @can('forceDelete', \App\Models\Client::class)
                                                                <form
                                                                    action="{{ route('clients.force_delete', $client->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <x-primary-button class="m-1">
                                                                        Delete Forever
                                                                    </x-primary-button>
                                                                </form>
                                                            @endcan
                                                        @else
                                                            @can('update', \App\Models\Client::class)
                                                                <x-primary-button class="m-1">
                                                                    <a href="/clients/{{ $client->id }}/edit">Edit</a>
                                                                </x-primary-button>
                                                            @endcan

                                                            @can('delete', \App\Models\Client::class)
                                                                <form action="/clients/{{ $client->id }}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <x-primary-button class="m-1">
                                                                        Delete
                                                                    </x-primary-button>
                                                                </form>
                                                            @endcan
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
