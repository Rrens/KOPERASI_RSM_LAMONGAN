<?php

namespace App\Http\Controllers;

use App\Models\Penjualan_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardConroller extends Controller
{
    public function index()
    {
        $active = 'dashboard';
        // $grafik =
        $data = Penjualan_details::join('products', 'products.id', '=', 'penjualan_details.id_product')
            ->select('products.nama', 'products.harga', DB::raw('SUM(penjualan_details.jumlah_barang) as jumlah_barang'), 'products.stok')
            ->groupBy('products.id')
            ->orderBy('jumlah_barang', 'DESC')
            ->get();
        // dd($data);

        $grafik = DB::table('penjualan_details as pd')
            ->select(
                DB::raw('COUNT(pd.id) as id_penjualan_detail'),
                DB::raw('DATE(p.created_at) as tanggal'),
                // 'pd.id_penjualan'
            )
            ->join('penjualan as p', 'p.id', '=', 'pd.id_penjualan')
            ->groupBy('pd.id_penjualan')
            ->orderBy('p.created_at')
            ->get();

        $penjualan_grafik = array();
        $bulan_grafik = array();

        foreach ($grafik as $item) {
            array_push($penjualan_grafik, $item->id_penjualan_detail);
            array_push($bulan_grafik, $item->tanggal);
        }

        // dd($penjualan_grafik, $bulan_grafik);
        // dd($data);
        return view('page.dashboard', compact('active', 'data', 'penjualan_grafik', 'bulan_grafik'));
    }
}
