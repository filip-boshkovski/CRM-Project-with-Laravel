<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-min mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @can('create', \App\Models\Project::class)
                        <div class="my-2">
                            <x-primary-button>
                                <a href="{{ route('projects.create') }}">Create Project</a>
                            </x-primary-button>
                            <x-primary-button>
                                <a href="{{ url('projects?archive') }}">View Archived Projects</a>
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
                                    Title
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Description
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Deadline
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Assigned User
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Assigned Client
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $project->id }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $project->title }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $project->description }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $project->deadline }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $project->user->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $project->client->company }}
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                        @if ($project->trashed())
                                            @can('restore', \App\Models\Project::class)
                                                <form action="{{ route('projects.restore', $project->id) }}" method="POST">
                                                    @csrf
                                                    <x-primary-button class="m-1">
                                                        Restore
                                                    </x-primary-button>
                                                </form>
                                            @endcan

                                            @can('forceDelete', \App\Models\Project::class)
                                                <form action="{{ route('projects.force_delete', $project->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <x-primary-button class="m-1">
                                                        Delete Forever
                                                    </x-primary-button>
                                                </form>
                                            @endcan
                                        @else
                                            @can('update', $project)
                                                <a href="{{ route('projects.edit', [$project->id]) }}"> <i
                                                        class="mx-1 fa fa-pencil" aria-hidden="true"></i></a>
                                            @endcan

                                            @can('delete', $project)
                                                <form action="{{ route('projects.destroy', [$project->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit">
                                                        <i class="mx-1 fa fa-trash" aria-hidden="true"></i>
                                                    </button>
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
