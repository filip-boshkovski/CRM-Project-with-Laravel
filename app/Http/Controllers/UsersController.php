<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::when($request->has('archive'), function ($query) {
            $query->onlyTrashed();
        })->get();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $data = $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:6'
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', User::class);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', User::class);

        $data = $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        $user->delete();

        return redirect()->route('users.index');
    }

    public function restore($id)
    {

        $client = User::onlyTrashed()->findOrFail($id);
        $client->restore();

        return redirect()->route('users.index');
    }

    public function forceDelete($id)
    {

        $client = User::onlyTrashed()->findOrFail($id);
        $client->forceDelete();

        return redirect()->route('users.index');
    }
}
