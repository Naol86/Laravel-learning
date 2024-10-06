<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        return response()->json([
            'message' => 'Clients retrieved successfully',
            'data' => $user->client
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        //
        $validated = $request->validated();
        $user = Auth::user();
        $validated['user_id'] = $user->id;

        $client = Client::create($validated);
        return response()->json([
            'message' => 'Client created successfully',
            'success' => true,
            'data' => $client
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
        if (Auth::user()->id != $client->user_id) {
            return response()->json([
                'message' => 'You are not authorized to update this client',
                'success' => false
            ]);
        }

        $validated = $request->validated();
        $client->update($validated);
        return response()->json([
            'message' => 'Client updated successfully',
            'success' => true,
            'data' => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // Check if the authenticated user is authorized to delete the client
        if (Auth::user()->id != $client->user->id) {
            return response()->json([
                'message' => 'You are not authorized to delete this client',
                'success' => false
            ]);
        }

        // Delete the client
        $client->delete();

        return response()->json([
            'message' => 'Client deleted successfully',
            'success' => [Auth::user(), $client]
        ]);
    }
}
