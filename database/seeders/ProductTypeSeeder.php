<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::create(["name" => "Bread"]);
        ProductType::create(["name" => "Pastry"]);
        ProductType::create(["name" => "Cake"]);
        ProductType::create(["name" => "Cookie"]);
        ProductType::create(["name" => "Sandwich"]);
        ProductType::create(["name" => "Savory"]);
        ProductType::create(["name" => "Dessert"]);
        ProductType::create(["name" => "Pie"]);
    }
}
