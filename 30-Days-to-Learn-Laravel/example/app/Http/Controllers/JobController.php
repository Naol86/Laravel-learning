<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    //
    public function index()
    {
        $job = Job::with('employer')->latest()->paginate(10);
        return view('jobs.index', [
            'jobs' => $job,
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store($request)
    {
        request()->validate([
            'title' => ['required', 'min:2'],
            'salary' => 'required',
        ]);

        $job = Job::create([
            'title' => $request->title,
            'salary' => $request->salary,
            'employer' => 1,
        ]);

        return redirect('/jobs');
    }

    public function show(Job $job)
    {
        return view('jobs.show', [
            'job' => $job,
        ]);
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'job' => $job,
        ]);
    }

    public function update(Request $request, Job $job)
    {
        request()->validate([
            'title' => ['required', 'min:2'],
            'salary' => 'required',
        ]);

        $job->update(request()->all());

        return redirect("/jobs/{$job->id}");
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect("/jobs");
    }
}
