<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Sequence;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::factory()
            ->count(2)
            ->create();

        $users = User::factory()
            ->count(3)
            ->create();

        $products = Product::factory()
            ->count(10)
            ->state(new Sequence(
                fn (Sequence $sequence) => [
                    'category_id' => $categories->random()->id,
                ],
            ))
            ->create();

        Order::factory()
            ->count(12)
            ->state(new Sequence(
                fn (Sequence $sequence) => [
                    'product_id' => $products->random()->id,
                    'user_id' => $users->random()->id,
                ],
            ))
            ->create();
    }
}
