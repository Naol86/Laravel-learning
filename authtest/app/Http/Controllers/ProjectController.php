<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreProjectRequest $request)
    {
        //
        $validated = $request->validated();
        $user = Auth::user();

        $client = Client::where('id', $request->client_id)->get()->first();
        $validated['user_id'] = $user->id;

        if ($client->user->id != $user->id) {
            return response()->json([
                'message' => "client doesn't exit",
                'success' => false,
            ]);
        }
    
        $project = Project::create($validated);

        $admins = [];
        foreach ($validated['admins'] as $adminId) {
            // Mark each admin user with 'is_admin' set to true
            $admins[$adminId] = ['is_admin' => true];
        }
        
        // Attach admin users to the project
        $project->projectUser()->attach($admins);

        $nonAdminUserIds = array_diff($request->user_ids, $validated['admins']);
        $project->projectUser()->attach($nonAdminUserIds);

        return response()->json([
            'message' => 'Project created successfully',
            'success' => true,
            'data' => $project
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
