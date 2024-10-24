<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    $job = Job::with('employer')->latest()->simplePaginate(5);
    return view('jobs.index', [
        'jobs' => $job
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::post('/jobs', function () {

    request()->validate([
        'title' => ['required', 'min:2'],
        'salary' => 'required',
    ]);

    $job = Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});

Route::get('/jobs/{id}', function (string $id) {
    $job = Job::find($id);
    return view('jobs.show', [
        'job' => $job,
    ]);
});

Route::get('/contact', function () {
    return view('contact');
});
