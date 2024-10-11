<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departments = Department::all();
        return $this->sendResponse($departments,"Department retrieved successfully.",200);
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
    public function store(StoreDepartmentRequest $request)
    {
        //
        $validator = Validator::make($request->all(), Department::$rules);
        if ($validator->fails()) {
            return $this->sendErrorResponse("validation fails", $validator->errors(), 422);
        }

        $department = Department::create($request->all());
        return $this->sendResponse($department,"department is created success fully",201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
        return $this->sendResponse($department,"department fetched successfully",200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        //
        $validator = Validator::make($request->all(), Department::$rules);
        if ($validator->fails()) {
            return $this->sendErrorResponse("validation error", $validator->errors(), 422);
        }

        $department->update($request->all());
        return $this->sendResponse($department, "department fetched successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
        $department->delete();
        return $this->sendResponse([], 'deleted successfully', 200);
    }
}