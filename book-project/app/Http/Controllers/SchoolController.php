<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $school = School::all();
        return $this->sendResponse($school, 'School retrieved successfully.', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest $request)
    {
        //
        $validator = Validator::make($request->all(), School::$rule);
        if ($validator->fails()) {
            return $this->sendErrorResponse('Validation Error.', $validator->errors(), 422);
        }

        $school = School::create($request->all());
        return $this->sendResponse($school, 'school is created successfully',201);

    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        //
        return $this->sendResponse($school, 'school is fetched',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        //
        $validator = Validator::make($request->all(), School::$rule);
        if ($validator->fails()) {
            return $this->sendErrorResponse('Validation error', $validator->errors(), 422);
        }

        $school->update($request->all());
        return $this->sendResponse($school,'school is updated successfully',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        //
        $school->delete();
        return $this->sendResponse([],'school is deleted successfully',200);
    }
}