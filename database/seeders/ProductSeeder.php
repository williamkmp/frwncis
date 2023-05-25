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
            "Bread" => ["Artisan Sour Dough Bread", "Whole Grain Sourdough", "Round Buckwheat Bread"],
            "Pastry" => ["Kwasong", "croissant", "Pann Au Chocolate"],
            "Cake" => ["Red Velvet Cake", "Birthday Cake", "Valentine Special Cake"],
            "Cookie" => ["Celebration Cookies Package", "New Year Hampers", "Assorted Cookie Package"],
            "Sandwich" => ["Roasted Chiken Sandwich", "Smoked Chiken Sandwich", "Club Beef Sandwich"],
            "Savory" => ["Margherita Pizza", "Formage Au Pizza", "Carbonara Pizza"],
            "Dessert" => ["Raspberry Vanilla Pudding", "Wildberry Pudding", "Vanilla Fan Berry"],
            "Pie" => ["Fresh Apple Pie", "Blackberyy pie", "All American Pie"]
        ];

        $types = ProductType::all();

        foreach ($types as $type ){
            $nameList = $nameMap[$type->name];
            $typeId = $type->id;
            $image_path = "/images/product/".strtolower($type->name).".jpg";
            foreach ($nameList as $name) {
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
}
