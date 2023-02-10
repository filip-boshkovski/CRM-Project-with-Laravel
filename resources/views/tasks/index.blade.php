<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @can('create', \App\Models\Task::class)
                        <div class="my-2">
                            <x-primary-button>
                                <a href="{{ route('tasks.create') }}">Create Task</a>
                            </x-primary-button>
                            <x-primary-button>
                                <a href="{{ url('tasks?archive') }}">View Archived Tasks</a>
                            </x-primary-button>
                        </div>
                    </div>
                @endcan
                <table class="w-full">
                    <thead class="bg-gray-200 border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-4 text-left">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-4 text-left">
                                Title
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-4 text-left">
                                Description
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-4 text-left">
                                Assigned User
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-4 text-left">
                                For Project
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $task->id }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-2 py-4 whitespace-nowrap">
                                    {{ $task->title }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-2 py-4 whitespace-nowrap">
                                    {{ $task->description }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-2 py-4 whitespace-nowrap">
                                    {{ $task->user->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-2 py-4 whitespace-nowrap">
                                    {{ $task->project->title }}
                                </td>

                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                    @if ($task->trashed())
                                        @can('restore', \App\Models\Task::class)
                                            <form action="{{ route('tasks.restore', $task->id) }}" method="POST">
                                                @csrf
                                                <x-primary-button class="m-1">
                                                    Restore
                                                </x-primary-button>
                                            </form>
                                        @endcan

                                        @can('forceDelete', \App\Models\Task::class)
                                            <form action="{{ route('tasks.force_delete', $task->id) }}" method="POST">
                                                @csrf
                                                <x-primary-button class="m-1">
                                                    Delete Forever
                                                </x-primary-button>
                                            </form>
                                        @endcan
                                    @else
                                        @can('update', $task)
                                            <a href="{{ route('tasks.edit', [$task->id]) }}"> <i class="mx-1 fa fa-pencil"
                                                    aria-hidden="true"></i></a>
                                        @endcan

                                        @can('delete', $task)
                                            <form action="{{ route('tasks.destroy', [$task->id]) }}" method="POST">
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
