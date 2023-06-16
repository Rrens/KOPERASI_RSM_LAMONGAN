<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Penjualan_details;
use App\Models\Products;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $data = User::where('role', 1)->get();
        return view('page.penjualan', compact('data'));
    }

    public function get_id_anggota($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

    public function get_id_product($id)
    {
        $product = Products::where('id', $id)->first();
        return response()->json($product);
    }

    public function post_table_kasir(Request $request)
    {
        // return response()->json($request->data[0]);
        try {
            $penjualan = new Penjualan();
            $penjualan->id_user = $request->data[0]['id_anggota'];
            $penjualan->subtotal = $request->data[0]['sub_total'];
            $penjualan->diskon = $request->data[0]['hasil_diskon'];
            $penjualan->total_bayar = $request->data[0]['uang_bayar'];
            $penjualan->kembalian = $request->data[0]['kembalian'];
            $penjualan->poin_tambah = $request->data[0]['tambahan_poin'];
            $penjualan->metode_pembayaran = $request->data[0]['metode_pembayaran'];
            // $penjualan->save();

            foreach ($request->data_detail as $row) {
                $penjualan_detail = new Penjualan_details();
                $penjualan_detail->id_penjualan = $penjualan->id;
                $penjualan_detail->id_product = $row['id_barang'];
                $penjualan_detail->harga_jual = $row['harga_jual'];
                $penjualan_detail->jumlah_barang = $row['jumlah_barang'];
                $penjualan_detail->harga_akhir = $row['harga_akhir'];
                // $penjualan_detail->save();
            }

            return response()->json([
                'meta' => [
                    'status' => 'Success',
                ],
                'data' => [
                    'penjualan' => $penjualan,
                    'penjualan_detail' => $penjualan_detail
                ]
            ], 200);

            //     $penjualan_detail->id_user = $request->data[0]->
            // $penjualan_detail->subtotal = $request->data[0]->
            // $penjualan_detail->diskon = $request->data[0]->
            // $penjualan_detail->total_bayar = $request->data[0]->
            // $penjualan_detail->kembalian = $request->data[0]->
            // $penjualan_detail->poin_tambah = $request->data[0]->
            // $penjualan_detail->metode_pembayaran = $request->data[0]->

        } catch (Exception $error) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'Something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
    }

    // public function
}
