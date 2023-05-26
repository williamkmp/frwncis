<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $products = Product::all()->take(5);

        foreach ($users as $user) {
            foreach ($products as $product) {
                CartItem::create([
                    "user_id" => $user->id,
                    "product_id" => $product->id,
                    "quantity" => $user->id,
                ]);
            }
        }
    }
}
