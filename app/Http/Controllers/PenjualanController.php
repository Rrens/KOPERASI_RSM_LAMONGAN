<?php

namespace App\Http\Controllers;

use App\Models\lap_anggota;
use App\Models\lap_penjualan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Penjualan_details;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $active = 'penjualan';
        // $data = Penjualan::with('user')->whereHas('user', function ($query) {
        //     $query->where('role', '!=', 0);
        // })->get();
        $data = Penjualan::get();
        $penjualan_detail = Penjualan_details::with('product')->get();

        $date = Carbon::now()->toDateString();
        return view('page.penjualan', compact('data', 'date', 'penjualan_detail', 'active'));
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

    public function get_id_penjualan($id)
    {
        $checkPenjualan = Penjualan::findOrFail($id);
        if (empty($checkPenjualan->id_user)) {
            $penjualan = DB::table('penjualan_details as pd')
                ->select(
                    'p.created_at as tanggal_penjualan',
                    'pd.id_product as id_barang',
                    'pr.kategori',
                    'pr.nama as nama_product',
                    'pd.jumlah_barang',
                    'pd.harga_akhir',
                )
                ->join('penjualan as p', 'p.id', '=', 'pd.id_penjualan')
                ->join('products as pr', 'pr.id', '=', 'pd.id_product')
                ->where(
                    'p.id',
                    $id
                )
                ->get();
        } else {
            $penjualan = DB::table('penjualan_details as pd')
                ->select(
                    'u.name as nama_user',
                    'u.poin as poin_user',
                    'u.credit as credit_user',
                    'u.id as id_user',
                    'p.created_at as tanggal_penjualan',
                    'pd.id_product as id_barang',
                    'pr.kategori',
                    'pr.nama as nama_product',
                    'pr.harga as harga_product',
                    'pd.jumlah_barang',
                    'pd.harga_akhir',
                )
                ->join('penjualan as p', 'p.id', '=', 'pd.id_penjualan')
                ->join('users as u', 'u.id', '=', 'p.id_user')
                ->join('products as pr', 'pr.id', '=', 'pd.id_product')
                ->where(
                    'p.id',
                    $id
                )
                ->get();
        }
        return response()->json($penjualan);
    }

    public function update_table_kasir(Request $request)
    {
        try {
            // return response()->json($request->data);
            $penjualan = Penjualan::findOrFail($request->data[0]['id_penjualan_edit']);
            $penjualan->id_user = $request->data[0]['id_anggota_edit'];
            $penjualan->subtotal = $request->data[0]['sub_total_edit'];
            $penjualan->diskon = $request->data[0]['hasil_diskon_edit'];
            $penjualan->total_bayar = $request->data[0]['uang_bayar_edit'];
            $penjualan->kembalian = $request->data[0]['kembalian_edit'];
            $penjualan->poin_tambah = $request->data[0]['tambahan_poin_edit'];
            $penjualan->metode_pembayaran = $request->data[0]['metode_pembayaran_edit'];
            $user = User::findOrFail($penjualan->id_user);

            $check_id_penjualan_detail = Penjualan_details::where('id_penjualan', $penjualan->id)->select('id')->first();

            $lap_anggota = lap_anggota::where('id_user', $user->id)->where('id_penjualan_detail', $check_id_penjualan_detail->id)->first();
            if (!empty($user)) {
                if ($request->data[0]['metode_pembayaran_edit'] == 'kredit') {
                    $user->credit = $user->credit + (int) $request->data[0]['nominal_bayar_edit'];
                    // $user->save();

                    $lap_anggota->credit_masuk = (int) $request->data[0]['nominal_bayar_edit'];
                } else {
                    $lap_anggota->credit_masuk = 0;
                }
                if ($request->data[0]['jumlah_poin_edit'] != null) {
                    if (!empty($user->poin)) {
                        // $lap_anggota->poin_keluar = 0;
                        // return response()->json($user->poin);
                        $lap_anggota->poin_keluar = $user->poin;
                    }
                    // $user = User::findOrFail($penjualan->id_user);
                    $user->poin = (int) $penjualan->poin_tambah;

                    // $user->save();

                    // $lap_anggota->poin_masuk = 0;
                    $lap_anggota->poin_masuk = (int) $penjualan->poin_tambah;
                } else {


                    // $user = User::findOrFail($penjualan->id_user);
                    $user->poin = (int) $penjualan->poin_tambah + $user->poin;
                    // $user->save();
                }
            }

            $user->save();
            // return response()->json($lap_anggota);
            $lap_anggota->tanggal = Carbon::now();
            $lap_anggota->save();
            $penjualan->save();

            $group_data = collect($request->data_detail)->groupBy('id_barang');
            // $penjualan_detail = Penjualan_details::where('id_penjualan', $penjualan->id)->delete();
            // return response()->json($group_data);
            foreach ($group_data as $item) {
                $productID = $item->first()['id_barang'];
                $total_stok = $item->sum('jumlah_barang');
                $total_harga = $item->sum('harga_akhir');
                $harga_jual = $item->first()['harga_jual'];


                // $penjualan_detail = new Penjualan_details();
                $penjualan_detail = Penjualan_details::where('id_penjualan', $penjualan->id)->where('id_product', $productID)->first();
                $penjualan_detail->id_penjualan = $penjualan->id;
                $penjualan_detail->id_product = $productID;
                $penjualan_detail->harga_jual = $harga_jual;
                // return response()->json($penjualan_detail);
                $penjualan_detail->harga_akhir = $total_harga;

                $product = Products::findOrFail($productID);
                // return response()->json($product->stok + $penjualan_detail->jumlah_barang);
                $product->stok = $product->stok - $total_stok;
                $penjualan_detail->jumlah_barang = $total_stok;
                $product->save();
                $penjualan_detail->save();
            }

            $lap_penjualan = lap_penjualan::where('id_penjualan_detail', $penjualan_detail->id)->first();
            // $lap_penjualan->barang_terjual = $penjualan_detail->jumlah_barang;
            // $lap_penjualan->pemasukan = Penjualan_details::where('id', $penjualan_detail->id)->sum('harga_jual');
            $lap_penjualan->keterangan = $request->data[0]['metode_pembayaran_edit'];
            $lap_penjualan->tanggal = Carbon::now();
            $lap_penjualan->save();



            // return response()->json($penjualan_detail);
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
        try {
            $penjualan = new Penjualan();

            $penjualan->subtotal = $request->data[0]['sub_total'];
            $penjualan->diskon = $request->data[0]['hasil_diskon'];
            $penjualan->total_bayar = $request->data[0]['uang_bayar'];
            $penjualan->kembalian = $request->data[0]['kembalian'];
            $penjualan->poin_tambah = (int) $request->data[0]['tambahan_poin'];
            $penjualan->metode_pembayaran = $request->data[0]['metode_pembayaran'];

            $lap_anggota = new lap_anggota();

            if ($request->data[0]['id_anggota'] != null) {
                // return response()->json($request->data[0]['id_anggota']);
                $penjualan->id_user = $request->data[0]['id_anggota'];
                $user = User::findOrFail($penjualan->id_user);
                // return response()->json($user);
                $lap_anggota->id_user = $user->id;

                if ($request->data[0]['metode_pembayaran'] == 'kredit') {
                    $user->credit = $user->credit + (int) $request->data[0]['nominal_bayar'];
                    $user->save();

                    $lap_anggota->credit_masuk = (int) $request->data[0]['nominal_bayar'];
                } else {
                    $lap_anggota->credit_masuk = 0;
                }
                if ($request->data[0]['jumlah_poin'] != null) {
                    $lap_anggota->poin_keluar = $user->poin;
                    $lap_anggota->poin_masuk = 0;
                    $user->poin =  $penjualan->poin_tambah;

                    $user->save();
                } else {
                    // $user = User::findOrFail($penjualan->id_user);
                    $user->poin = $penjualan->poin_tambah + $user->poin;
                    $lap_anggota->poin_masuk = $penjualan->poin_tambah;
                    $lap_anggota->poin_keluar = 0;
                    // return response()->json($user);
                    $user->save();
                }
            } else {
                $penjualan->id_user = $request->data[0]['id_anggota'];
            }
            $check_id_penjualan_detail = Penjualan_details::where('id_penjualan', $penjualan->id)->select('id')->first();
            $lap_anggota->tanggal = Carbon::now();
            // $lap_anggota->id_penjualan_detail = $check_id_penjualan_detail->id;

            $penjualan->save();
            $group_data = collect($request->data_detail)->groupBy('id_barang');

            foreach ($group_data as $item) {
                $productID = $item->first()['id_barang'];
                $total_stok = $item->sum('jumlah_barang');
                $total_harga = $item->sum('harga_akhir');
                $harga_jual = $item->first()['harga_jual'];

                $product = Products::findOrFail($productID);
                $product->stok -= $total_stok;
                $product->save();

                $penjualan_detail = new Penjualan_details();
                $penjualan_detail->id_penjualan = $penjualan->id;
                $penjualan_detail->id_product = $productID;
                $penjualan_detail->harga_jual = $harga_jual;
                $penjualan_detail->jumlah_barang = $total_stok;
                $penjualan_detail->harga_akhir = $total_harga;
                $penjualan_detail->save();
            }

            $lap_anggota->id_penjualan_detail = $penjualan_detail->id;
            $lap_anggota->credit_keluar = 0;
            $lap_anggota->save();

            $lap_penjualan = new lap_penjualan();
            $lap_penjualan->id_penjualan_detail = $penjualan_detail->id;
            // $lap_penjualan->barang_terjual = $penjualan_detail->jumlah_barang;
            // $lap_penjualan->pemasukan = Penjualan_details::where('id', $penjualan_detail->id)->sum('harga_jual');
            $lap_penjualan->keterangan = $request->data[0]['metode_pembayaran'];
            $lap_penjualan->tanggal = Carbon::now();
            $lap_penjualan->save();
            // return response()->json($lap_penjualan->save());

            // return response()->json([
            //     'meta' => [
            //         'status' => 'Success',
            //     ],
            //     'data' => [
            //         'penjualan' => $penjualan,
            //         'penjualan_detail' => $penjualan_detail
            //     ]
            // ], 200);
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
