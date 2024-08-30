<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => OrderResource::collection(auth()->user()->orders)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|numeric|int|exists:App\Models\Product,id',
            'quantity' => 'required|numeric|int|min:1'
        ]);

        $product = Product::find($data['product_id']);

        $data['user_id'] = auth()->user()->id;
        $data['total_price'] = $data['quantity'] * $product->price;
        $newOrder = Order::create($data);

        return response()->json([
            'message' => 'success',
            'data' => new OrderResource($newOrder)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Order::find($id);
        if (!$data || $data->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => new OrderResource($data)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);
        if (!$order || $order->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        $data = $request->validate([
            'product_id' => 'required|numeric|int|exists:App\Models\Product,id',
            'quantity' => 'required|numeric|int|min:1'
        ]);

        $product = Product::find($data['product_id']);
        $data['total_price'] = $data['quantity'] * $product->price;

        $order->update($data);
        return response()->json([
            'message' => 'success',
            'data' => new OrderResource($order)
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if (!$order || $order->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        $order->delete();
        return response()->json([
            'message' => 'success',
        ]);
    }
}
