<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product = Product::simplePaginate(5);
        $products = ProductResource::collection($product);
        // return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.', 200);
        return $this->sendResponse($products, 'Product retrieved successfully.', 200);
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
    public function store(StoreProductRequest $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'detail' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $product = Product::create($request->all());
        return $this->sendResponse($product, 'Product created successfully.', 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        //
        $product = Product::findOrFail($id);
        if (is_null($product)) {
            return $this->sendError('Product not found.', code: 404);
        }
        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        if (count($request->all()) === 0) {
            return $this->sendError('Validation Error.', ['Request data is empty.'], 422);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'detail' => 'string|max:255',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product->update($request->all());
        return $this->sendResponse($product, 'Product updated successfully.', 200); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return $this->sendResponse([], 'Product deleted successfully.', 200);
    }
}