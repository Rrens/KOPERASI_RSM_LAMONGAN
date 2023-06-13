<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penjualan_details')->insert([
            [
                'id_penjualan' => 1,
                'id_product' => 1,
                'harga_jual' => 15000,
                'jumlah_barang' => 2,
                'harga_akhir' => 30000,
            ],
            [
                'id_penjualan' => 1,
                'id_product' => 2,
                'harga_jual' => 10000,
                'jumlah_barang' =>  1,
                'harga_akhir' => 10000,
            ],
        ]);
    }
}
