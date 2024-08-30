<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'customer_name',
        'customer_address',
    ];
    public $useTimestamps = true;

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected static function boot() {
        parent::boot();

        static::creating(function ($order) {
            $order->total_price = $order->product->price * $order->quantity;
        });

        static::updating(function ($order) {
            $order->total_price = $order->product->price * $order->quantity;
        });
    }
}
