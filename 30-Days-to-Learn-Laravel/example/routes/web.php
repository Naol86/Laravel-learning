<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;



Route::get('/', function() {
    return view('home');
});

Route::get('/jobs', function ()  {
    return view('jobs', [
        'jobs' => Job::with('employer')->get(),
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