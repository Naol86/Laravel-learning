<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job
{
    public static function all():array {
        return [
            [
                'id'=> 1,
                'title' => 'Director',
                'salary' => 1200,
                
            ]
            ,
            [
                'id'=> 2,
                'title' => 'Manager',
                'salary' => 1000,
            ],
            [
                'id'=> 3,
                'title' => 'Engineer',
                'salary' => 900,
            ],
            [
                'id'=> 4,
                'title' => 'Technician',
                'salary' => 800,
            ],
            [
                'id'=> 5,
                'title' => 'Clerk',
                'salary' => 700,
            ],
            [
                'id'=> 6,
                'title' => 'Intern',
                'salary' => 500,
            ]
            ];
    }
    public static function find(int $id): array {
        $job = Arr::first( self::all(), fn($job) => $job['id'] == $id );
        if (! $job) {
            abort(404);
        }
        return $job;
    }
}