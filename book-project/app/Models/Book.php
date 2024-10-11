<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author',
        'description',
        'file',
        'image',
        'course_id'
    ];

    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'author' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:255'],
        'file' => ['required', 'string', 'max:255'],
        'image' => ['required', 'string', 'max:255'],
        'course_id' => ['required', 'integer', 'exists:courses,id'],
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}