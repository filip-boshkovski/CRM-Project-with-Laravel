<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientsResource;

class ClientsController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return ClientsResource::collection(Client::paginate(10));
    }


    public function show(Client $client)
    {
        return new ClientsResource($client);
    }
}
