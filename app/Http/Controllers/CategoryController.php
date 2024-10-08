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

        $newCategory = Category::create($data);
        return response()->json([
            'message' => 'success',
            'data' => $newCategory
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Category::find($id);
        if (!$data) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $category->update($data);

        return response()->json([
            'message' => 'success',
            'data' => $category
        ], 201);
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
        ]);
    }
}
