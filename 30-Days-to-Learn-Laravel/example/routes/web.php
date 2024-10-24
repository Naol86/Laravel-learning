<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// index
Route::get('/jobs', function () {
    $job = Job::with('employer')->latest()->simplePaginate(5);
    return view('jobs.index', [
        'jobs' => $job
    ]);
});
// create new job form
Route::get('/jobs/create', function () {
    return view('jobs.create');
});
// store new job
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

// show job details
Route::get('/jobs/{id}', function (string $id) {
    $job = Job::find($id);
    return view('jobs.show', [
        'job' => $job,
    ]);
});

// edit job form
Route::get('/jobs/{id}/edit', function (string $id) {
    $job = Job::find($id);
    return view('jobs.edit', [
        'job' => $job,
    ]);
});

// update job
Route::patch('/jobs/{id}', function (string $id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:2'],
        'salary' => 'required',
    ]);
    // validation
    // update
    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $id);
});

// delete job
Route::delete('/jobs/{id}', function (string $id) {
    $job = Job::findOrFail($id);
    $job->delete();
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
