<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'nama' => 'momogi',
                'harga' => 15000,
                'kategori' => 'makanan',
                'stok' => 200,
            ],
            [
                'nama' => 'nabati',
                'harga' => 10000,
                'kategori' => 'makanan',
                'stok' => 100,
            ],
        ]);
    }
}
