<?php

namespace App\Http\Controllers;

use App\Models\lap_anggota;
use App\Models\lap_anggota_detail;
use App\Models\lap_pembelian;
use App\Models\lap_penjualan;
use App\Models\Pembelian;
use App\Models\pembelian_details;
use App\Models\Penjualan;
use App\Models\Penjualan_details;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $active = 'laporan';
        $lap_anggota_detail = lap_anggota_detail::with('user', 'penjualan')->get();
        $lap_anggota = lap_anggota::all();

        // $lap_penjualan = lap_penjualan::with('penjualan')
        //     // ->join('penjualan_details', 'lap_penjualan.id', '=', 'penjualan_details.id_penjualan')
        //     // // ->join('products', 'products.id', '=', 'penjualan_details.id_product')
        //     ->get();
        $lap_penjualan = DB::table('lap_penjualan as lp')
            ->join('penjualan as pj', 'pj.id', '=', 'lp.id_penjualan')
            ->join('penjualan_details as pd', 'pj.id', '=', 'pd.id_penjualan')
            ->join('products as p', 'p.id', '=', 'pd.id_product')
            ->groupBy('pj.id')
            ->get();

        $lap_pembelian = lap_pembelian::all();

        $pembelian_detail = pembelian_details::with('product')->get();
        $penjualan_detail = Penjualan_details::with('product')->get();
        $user = User::all();
        // dd($lap_anggota_detail);
        return view('page.laporan', compact('user', 'lap_anggota', 'lap_anggota_detail', 'lap_penjualan', 'lap_pembelian', 'pembelian_detail', 'penjualan_detail', 'active'));
    }

    public function print_anggota($id)
    {
        // $data = User::where('id', $id)->get();
        $lap_anggota = lap_anggota::findOrFail($id);
        $data = lap_anggota_detail::with('user')->where('id_lap_anggota', $id)->get();
        $anggota_baru = User::where('tanggal', $lap_anggota->tanggal)->count('tanggal');
        $jumlah = $data->where('id_lap_anggota', $id)->count('id');
        $total_pendapatan = $data->where('id_lap_anggota', $id)->sum('total_bayar');

        return view('page.print_anggota', compact('data', 'anggota_baru', 'jumlah', 'total_pendapatan'));
    }

    public function print_pembelian($id)
    {
        $data = Pembelian::where('id', $id)->get();
        return view('page.print_pembelian', compact('data'));
    }

    public function print_penjualan($id)
    {
        $data = Penjualan::where('id', $id)->get();
        return view('page.print_penjualan', compact('data'));
    }
}
