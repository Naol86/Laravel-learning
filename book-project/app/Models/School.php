<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
    ];

    public static $rule = [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:255'],
    ];

    public function department(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}