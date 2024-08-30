<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderReportCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $price = 0;
        foreach ($this->collection as $order) {
            $price += $order->total_price;
        }

        return [
            'total_orders' => $this->collection->count(),
            'total_revenue' => $price,
            'orders' => OrderReportResource::collection($this->collection)
        ];
    }
}
