<?php

namespace App\Http\Controllers;

use App\Models\lap_anggota;
use App\Models\lap_pembelian;
use App\Models\lap_penjualan;
use App\Models\pembelian_details;
use App\Models\Penjualan_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $active = 'laporan';
        $lap_anggota = lap_anggota::with('user')->get();
        // $lap_penjualan = lap_penjualan::with('penjualan_detail')->get();
        $lap_penjualan = DB::table('lap_penjualan as lp')
            ->join('penjualan_details as pd', 'pd.id', '=', 'lp.id_penjualan_detail')
            ->join('products as p', 'p.id', '=', 'pd.id_product')
            ->join('penjualan as pj', 'pj.id', '=', 'pd.id_penjualan')
            ->get();
        $lap_pembelian = lap_pembelian::all();

        $pembelian_detail = pembelian_details::with('product')->get();
        $penjualan_detail = Penjualan_details::all();
        // dd($lap_penjualan);
        return view('page.laporan', compact('lap_anggota', 'lap_penjualan', 'lap_pembelian', 'pembelian_detail', 'penjualan_detail', 'active'));
    }
}
