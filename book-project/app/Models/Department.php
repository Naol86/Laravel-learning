<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "school_id",
    ];

    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'description'=> ['required', 'string','max:255'],
        'school_id' => ['required', 'integer', 'exists:schools,id'],
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}