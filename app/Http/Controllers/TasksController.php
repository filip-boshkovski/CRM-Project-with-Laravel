<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::with('user', 'project')->when($request->has('archive'), function ($query) {
            $query->onlyTrashed();
        })->get();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Task::class);

        $users = User::all()->pluck('name', 'id');
        $projects = Project::all()->pluck('title', 'id');

        return view('tasks.create', ['users' => $users, 'projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Task::class);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id'
        ]);

        Task::create($data);

        return redirect()->route('tasks.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $users = User::all()->pluck('name', 'id');
        $projects = Project::all()->pluck('title', 'id');

        return view('tasks.edit', ['task' => $task, 'users' => $users, 'projects' => $projects]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id'
        ]);

        $task->update($data);

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index');
    }


    public function restore($id)
    {
        $this->authorize('restore', Task::class);

        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->route('tasks.index');
    }


    public function forceDelete($id)
    {
        $this->authorize('restore', Tasks::class);

        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();

        return redirect()->route('tasks.index');
    }
}
