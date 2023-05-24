<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            Location::create([
                "city" => $faker->city(),
                "address" => $faker->streetAddress(),
                "opening_hours" => "07:00",
                "closing_hours" => "20:00",
                "image_path" => "images/location/".($i % 5).".jpg",
            ]);
        }
    }
}
