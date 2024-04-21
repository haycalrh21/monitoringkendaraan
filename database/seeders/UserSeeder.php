<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Buat beberapa user admin dengan data fake

        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@admin.com'), // Atur password sesuai kebutuhan
            'role' => 'admin',

            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => 'atasan1@gmail.com',
            'password' => Hash::make('atasan1@gmail.com'), // Atur password sesuai kebutuhan
            'role' => 'atasan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => 'atasan2@gmail.com',
            'password' => Hash::make('atasan2@gmail.com'), // Atur password sesuai kebutuhan
            'role' => 'atasan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
