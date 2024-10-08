<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();
        return response()->json(
            [
                'message' => 'success',
                'success' => true,
                'data' => $posts 
            ]
            );
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
    public function store(StorePostRequest $request)
    {
        //
        $validateData = $request->validated();
        
        $post = Post::create($validateData);
        return response()->json(
            [
                'message' => 'success',
                'success' => true,
                'data' => $post 
            ], 201
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return response()->json(
            [
                'message' => 'success',
                'success' => true,
                'data' => $post 
            ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        $validateData = $request->validated();
        $post->update($validateData);
        return response()->json(
            [
                'message' => 'success',
                'success' => true,
                'data' => $post 
            ]
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return response()->json(
            [
                'message' => 'success',
                'success' => true,
            ]
            );
    }
}
