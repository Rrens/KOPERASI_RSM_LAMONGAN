<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'password' => Hash::make('123123'),
                'phone' => '081212121212',
                'address' => 'surabaya',
                'nik' => '081212121212',
                'gender' => 0,
                'role' => 0,
            ],
            [
                'name' => 'user',
                'password' => Hash::make('123123'),
                'phone' => '081212121212',
                'address' => 'surabaya',
                'nik' => '081212121212',
                'gender' => 0,
                'role' => 1,
            ],
        ]);
    }
}
