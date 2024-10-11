<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'department_id',
    ];

    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:255'],
        'code'=> ['required', 'string','max:255'],
        'department_id' => ['required', 'integer', 'exists:departments,id'],
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function book(): HasMany
    {
        return $this->hasMany(Book::class);
    }

}