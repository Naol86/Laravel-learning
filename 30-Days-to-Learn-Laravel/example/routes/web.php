<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('home');
});

Route::get('/jobs', function () {
    $jobs = [
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
    return view('jobs', [
        'jobs' => $jobs,
    ]);
});

Route::get('/jobs/{id}', function (string $id) {
    $jobs = [
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
    $job = Arr::first( $jobs, fn($job) => $job['id'] == $id );

    return view('job', [
        'job' => $job
    ]);
});

Route::get('/contact', function() {
    return view('contact');
});