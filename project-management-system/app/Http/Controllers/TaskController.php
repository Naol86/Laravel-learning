<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        return response()->json([
            'message' => 'tasks',
            'success' => true,
            'data' => $user->tasks
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
    public function store(StoreTaskRequest $request)
    {
        //
        $validated = $request->validated();
        $user = Auth::user();

        $project = Project::where('id', $request->project_id)->get()->first();
        if ($project->users->hasRole('admin') == false) {
            return response()->json([
                'message' => "user doesn't exit in project",
                'success' => false,
            ]);
        }
        if ($user->id != $request->created_by) {
            $createdBy = User::where('id', $request->created_by)->get()->first();
            if ($createdBy->hasRole('member')) {
                return response()->json([
                    'message' => "user doesn't exit has role",
                    'success' => $createdBy->roles,
                ]);
            }
            return response()->json([
                'message' => "user doesn't exit",
                'success' => $createdBy->roles,
            ]);
        }

        $validated['user_id'] = $user->id;
        $task = Task::create($validated);
        return response()->json([
            'message' => 'task created',
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
        return response()->json([
            'message' => 'task',
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
