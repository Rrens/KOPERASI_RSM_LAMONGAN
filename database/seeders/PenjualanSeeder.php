<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penjualan')->insert([
            [
                'id_user' => 2,
                'total_bayar' => 50000,
                'kembalian' => 10000,
                'diskon' => 0,
                'subtotal' => 40000,
                'poin_tambah' => 0,
                'metode_pembayaran' => 'tunai',
            ],
        ]);
    }
}
