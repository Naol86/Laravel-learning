<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        // "user_id",
    ];

    public function usersWithRoles(): BelongsToMany
    {
    return $this->belongsToMany(User::class, 'project_user_roles')
                ->withPivot('role_id')
                ->withTimestamps();
    }

}