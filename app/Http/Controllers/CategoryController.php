<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        Category::create($data);
        return response()->json([
            'message' => 'success',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Category::find($id)) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Category::find($id)) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $category = Category::find($id);
        $category->update($data);

        return response()->json([
            'message' => 'success',
            'data' => $category
        ], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Category::find($id)) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        Category::destroy($id);

        return response()->json([
            'message' => 'success'
        ], 204);
    }
}
