<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::all();
        return $this->sendResponse($courses,"Courses retrieved successfully.",200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        //
        $validator = Validator::make($request->all(), Course::$rules);
        if ($validator->fails()) {
            return $this->sendErrorResponse("validation error",$validator->errors(),422);
        }
        $course = Course::create($request->all());
        return $this->sendResponse($course,"course created successfully",201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
        return $this->sendResponse($course,"course fetched successfully",200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
        $validator = Validator::make($request->all(), Course::$rules);
        if ($validator->fails()) {
            return $this->sendErrorResponse("validation error",$validator->errors(),422);
        }
        $course->update($request->all());
        return $this->sendResponse($course,"course updated successfully",200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
        $course->delete();
        return $this->sendResponse([],"course deleted successfully",200);
    }
}