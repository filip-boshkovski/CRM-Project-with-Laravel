<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::when($request->has('archive'), function ($query) {
            $query->onlyTrashed();
        })->get();

        return view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Client::class);

        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('create', Client::class);

        $data = $request->validate([
            'company' => 'required|unique:clients|max:255',
            'city' => 'required|max:50',
            'VAT' => 'required|numeric',
            'address' => 'required'
        ]);

        Client::create($data);

        return redirect()->route('clients.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $this->authorize('update', Client::class);

        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->authorize('update', Client::class);

        $data = $request->validate([
            'company' => 'required|max:255',
            'city' => 'required|max:50',
            'VAT' => 'required|numeric',
            'address' => 'required'
        ]);

        $client->update($data);

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', Client::class);

        $client->delete();

        return redirect()->route('clients.index');
    }


    public function restore($id)
    {
        $this->authorize('restore', Client::class);

        $client = Client::onlyTrashed()->findOrFail($id);
        $client->restore();

        return redirect()->route('clients.index');
    }


    public function forceDelete($id)
    {
        $this->authorize('forceDelete', Client::class);

        $client = Client::onlyTrashed()->findOrFail($id);
        $client->forceDelete();

        return redirect()->route('clients.index');
    }
}
