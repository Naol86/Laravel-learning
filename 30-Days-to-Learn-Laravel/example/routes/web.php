<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;



Route::get('/', function() {
    return view('home');
});

Route::get('/jobs', function ()  {
    $job = Job::with('employer')->simplePaginate(5);
    return view('jobs', [
        'jobs' => $job
    ]);
});

Route::get('/jobs/{id}', function (string $id)  {
    return view('job', [
        'job' => Job::find( $id ),
    ]);
});

Route::get('/contact', function() {
    return view('contact');
});