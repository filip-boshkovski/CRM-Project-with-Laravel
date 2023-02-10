<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::with('user', 'client')->when($request->has('archive'), function ($query) {
            $query->onlyTrashed();
        })->get();

        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $users = User::all()->pluck('name', 'id');
        $clients = Client::all()->pluck('company', 'id');

        return view('projects.create', ['users' => $users, 'clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id'
        ]);

        Project::create($data);

        return redirect()->route('projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $users = User::all()->pluck('name', 'id');
        $clients = Client::all()->pluck('company', 'id');

        return view('projects.edit', ['project' => $project, 'users' => $users, 'clients' => $clients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id'
        ]);

        $project->update($data);

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index');
    }


    public function restore($id)
    {
        $this->authorize('restore', Project::class);

        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('projects.index');
    }


    public function forceDelete($id)
    {
        $this->authorize('restore', Project::class);

        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->route('projects.index');
    }
}
