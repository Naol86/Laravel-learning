<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::all();
        return $this->sendResponse($books, "Books retrieved successfully.", 200);
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
    public function store(StoreBookRequest $request)
    {
        //
        $validator = Validator::make($request->all(), Book::$rules);
        if ($validator->fails()) {
            return $this->sendErrorResponse("validation error", $validator->errors(), 422);
        }

        $book = Book::create($request->all());
        return $this->sendResponse($book, "book is created successfully",201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
        return $this->sendResponse($book, "book is fetched",200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
        $validator = Validator::make($request->all(), Book::$rules);
        if ($validator->fails()) {
            return $this->sendErrorResponse("validation error", $validator->errors(),422);
        }

        $book->update($request->all());
        return $this->sendResponse($book,"book is updated",200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return $this->sendResponse([], "book is deleted", 200);
    }
}