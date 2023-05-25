<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $nameMap = [
            "Bread" => "Artisan Sour Dough Bread",
            "Pastry" => "Kwasong",
            "Cake" => "Red Velvet Cake",
            "Cookie" => "Celebration Cookies Package",
            "Sandwich" => "Roasted Chiken Sandwich",
            "Savory" => "Margherita Pizza",
            "Dessert" => "Raspberry Vanilla Pudding",
            "Pie" => "Fresh Apple Pie"
        ];

        $types = ProductType::all();

        foreach ($types as $type ){
            $name = $nameMap[$type->name];
            $typeId = $type->id;
            $image_path = "/images/product/".strtolower($type->name).".jpg";
            Product::create([
                "product_type_id" => $typeId,
                "name" => $name,
                "price" => $faker->numberBetween(50,100) * 1000,
                "description" => $faker->text(120),
                "image_path" => $image_path,
            ]);
        }
    }
}
