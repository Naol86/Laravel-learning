<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class CheckProjectRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    protected function hasRoleInProject($user, $project, $roleName)
    {
        $role = Role::where("name", $roleName)->first();
        // print_r($role);
        return $project->usersWithRoles()
                        ->where('user_id', $user->id)
                        ->where('role_id', Role::where('name', $roleName)->first()->id)
                        ->exists();
    }
    public function handle(Request $request, Closure $next, $role): Response
    {
        $project = $request->route('project');
        // print_r($rou);
        // $project = Project::find(3);  // Assuming project ID is in the route

        $user = request()->user();

        if (!$project || !$this->hasRoleInProject($user, $project, $role)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}