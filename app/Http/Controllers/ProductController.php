<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => ProductResource::collection(Product::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|int|exists:App\Models\Category,id',
        ]);

        $newProduct = Product::create($data);

        return response()->json([
            'message' => 'success',
            'data' => [
                'id' => $newProduct->id
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Product::find($id)) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => new ProductResource(Product::find($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|int|exists:App\Models\Category,id',
        ]);

        $product->update($data);
        return response()->json([
            'message' => 'success',
        ], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Product::find($id)) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        Product::destroy($id);

        return response()->json([
            'message' => 'success'
        ], 204);
    }
}
