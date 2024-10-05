<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function client(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function task(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function createdBy(): HasMany
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function projectUser(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_users');
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
