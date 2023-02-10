<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @can('create', \App\Models\User::class)
                        <div class="my-2">
                            <x-primary-button>
                                <a href="{{ route('users.create') }}">Create User</a>
                            </x-primary-button>
                            <x-primary-button>
                                <a href="{{ url('users?archive') }}">View Archived Users</a>
                            </x-primary-button>
                        </div>
                    @endcan
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Email
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $user->id }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $user->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $user->email }}
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                        @if ($user->trashed())
                                            @can('restore', \App\Models\User::class)
                                                <form action="{{ route('users.restore', $user->id) }}" method="POST">
                                                    @csrf
                                                    <x-primary-button class="m-1">
                                                        Restore
                                                    </x-primary-button>
                                                </form>
                                            @endcan

                                            @can('forceDelete', \App\Models\User::class)
                                                <form action="{{ route('users.force_delete', $user->id) }}" method="POST">
                                                    @csrf
                                                    <x-primary-button class="m-1">
                                                        Delete Forever
                                                    </x-primary-button>
                                                </form>
                                            @endcan
                                        @else
                                            @can('update', \App\Models\User::class)
                                                <x-primary-button class="m-1">
                                                    <a href="{{ route('users.edit', [$user->id]) }}">Edit</a>
                                                </x-primary-button>
                                            @endcan

                                            @can('delete', \App\Models\User::class)
                                                <form action="{{ route('users.destroy', [$user->id]) }}" method="POST">
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
</x-app-layout>
