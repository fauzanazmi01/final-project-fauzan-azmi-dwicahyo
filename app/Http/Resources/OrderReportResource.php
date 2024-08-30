<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product->name,
            'category_name' => $this->product->category->name,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'customer_name' => $this->user->name,
            'order_date' => $this->order_date,
        ];
    }
}
