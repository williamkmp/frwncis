<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Test User Name",
            "role" => "Member",
            "email" => "test@email.com",
            "password" => bcrypt("password"),
        ]);

        User::create([
            "name" => "William Kurnia Mulyadi Putra",
            "role" => "Member",
            "email" => "william.putra003@binus.ac.id",
            "password" => bcrypt("2301887521"),
        ]);

        User::create([
            "name" => "Muhammad Daffa Syamsuddin",
            "role" => "Member",
            "email" => "m.syamsuddin003@binus.ac.id",
            "password" => bcrypt("2301957603"),
        ]);

        User::create([
            "name" => "Administrator",
            "role" => "Admin",
            "email" => "admin@email.com",
            "password" => bcrypt("password"),
        ]);
    }
}
