<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Penjualan_details;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $data = Penjualan::with('user')->whereHas('user', function ($query) {
            $query->where('role', 1);
        })->get();
        $penjualan_detail = Penjualan_details::with('product')->get();
        // dd($data);
        $date = Carbon::now()->toDateString();
        return view('page.penjualan', compact('data', 'date', 'penjualan_detail'));
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

    public function update_table_kasir(Request $request)
    {
        try {
            // return response()->json($request->data_detail);
            $penjualan = Penjualan::findOrFail($request->data[0]['id_penjualan']);
            $penjualan->id_user = $request->data[0]['id_anggota_edit'];
            $penjualan->subtotal = $request->data[0]['sub_total_edit'];
            $penjualan->diskon = $request->data[0]['hasil_diskon_edit'];
            $penjualan->total_bayar = $request->data[0]['uang_bayar_edit'];
            $penjualan->kembalian = $request->data[0]['kembalian_edit'];
            $penjualan->poin_tambah = $request->data[0]['tambahan_poin_edit'];
            $penjualan->metode_pembayaran = $request->data[0]['metode_pembayaran_edit'];
            $penjualan->save();

            $group_data = collect($request->data_detail)->groupBy('id_barang');
            $penjualan_detail = Penjualan_details::where('id_penjualan', $penjualan->id)->delete();
            // return response()->json($group_data);
            foreach ($group_data as $item) {
                $productID = $item->first()['id_barang'];
                $total_stok = $item->sum('jumlah_barang');
                $total_harga = $item->sum('harga_akhir');
                $harga_jual = $item->first()['harga_jual'];

                $penjualan_detail = new Penjualan_details();
                $penjualan_detail->id_penjualan = $penjualan->id;
                $penjualan_detail->id_product = $productID;
                $penjualan_detail->harga_jual = $harga_jual;
                $penjualan_detail->jumlah_barang = $total_stok;
                $penjualan_detail->harga_akhir = $total_harga;
                $penjualan_detail->save();
            }


            return response()->json($penjualan_detail);
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
            $penjualan->save();
            $group_data = collect($request->data_detail)->groupBy('id_barang');

            foreach ($group_data as $item) {
                $productID = $item->first()['id_barang'];
                $total_stok = $item->sum('jumlah_barang');
                $total_harga = $item->sum('harga_akhir');
                $harga_jual = $item->first()['harga_jual'];

                $penjualan_detail = new Penjualan_details();
                $penjualan_detail->id_penjualan = $penjualan->id;
                $penjualan_detail->id_product = $productID;
                $penjualan_detail->harga_jual = $harga_jual;
                $penjualan_detail->jumlah_barang = $total_stok;
                $penjualan_detail->harga_akhir = $total_harga;
                $penjualan_detail->save();
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

    public function delete_table_kasir(Request $request)
    {
        try {
            return response()->json($request->all());
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
