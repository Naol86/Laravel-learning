<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        return response()->json([
            'message' => 'projects',
            'success' => true,
            'data' => $user->projects
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
    public function store(StoreProjectRequest $request)
    {
        //
        $validated = $request->validated();
        $user = Auth::user();
        $validated['owner'] = $user->id;

        $client = Client::where('id', $request->client_id)->get()->first();

        if ($client->user->id != $user->id) {
            return response()->json([
                'message' => "client doesn't exit",
                'success' => false,
            ]);
        }

        $validated['user_id'] = $user->id; 

        $project = Project::create($validated);
        $owner = Role::where('name', 'owner')->first();
        $admin = Role::where('name', 'admin')->first();
        $member = Role::where('name', 'member')->first();

        $project->users()->attach($validated['admins'], ['role_id' => $admin->id]);
        
        $nonAdminUserIds = array_diff($request->user_ids, $validated['admins']);
        $project->users()->attach($nonAdminUserIds, ['role_id' => $member->id]);

        $project->users()->attach($user->id, ['role_id' => $owner->id]);

        return response()->json([
            'message' => 'Project is created successfully',
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
        $user = Auth::user();
        $users = $project->users()->get();
        if ($users->contains("id", $user->id)) {
            return response()->json([
                'message' => 'project is fetched',
                'success' => true,
                'data' => $project
            ]);
        }
        
        return response()->json([
            'message' => 'you are not allowed to access this user',
            'success' => false,
            'data' => $project->users()->get()
        ]);
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
