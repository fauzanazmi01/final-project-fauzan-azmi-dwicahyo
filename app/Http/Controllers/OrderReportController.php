<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderReportCollection;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderReportController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Order report generated successfully',
            'data' => new OrderReportCollection(Order::all())
        ]);
    }
}
