<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        return view('page.pembelian');
    }

    public function store(Request $request)
    {
        try {
            $pembelian = new Pembelian();
            // return response()->json($item);
            $pembelian->harga_beli = $request->data[0]['harga_beli'];
            $pembelian->harga_jual = $request->data[0]['harga_jual'];
            $pembelian->total_harga = $request->data[0]['total_harga'];
            $pembelian->jumlah_barang = $request->data[0]['jumlah_barang'];
            $pembelian->keterangan = $request->data[0]['keterangan'];
            // $pembelian->save();

            $group_data = collect($request->data)->groupBy('nama_barang');
            // return response()->json($group_data);

            foreach ($group_data as $item) {

                $nama_produk = $item->first()['nama_barang'];
                $harga = (int) $item->first()['harga_beli'];
                $kategori = $item->first()['kategori'];
                $stok = (int) $item->sum('jumlah_barang');

                $checkSameProduct = Products::where('nama', $nama_produk)->first();
                // return response()->json($checkSameProduct);
                if (empty($checkSameProduct)) {
                    $product = new Products();
                    $product->id_pembelian = $pembelian->id;
                    $product->nama = $nama_produk;
                    $product->harga = $harga;
                    $product->kategori = $kategori;
                    $product->stok = $stok;
                    $product->save();
                } else {
                    $checkSameProduct->id_pembelian = $pembelian->id;
                    $checkSameProduct->nama = $nama_produk;
                    $checkSameProduct->harga = $harga;
                    $checkSameProduct->kategori = $kategori;
                    $checkSameProduct->stok = $stok + $checkSameProduct->stok;
                    $checkSameProduct->save();
                }
            }

            return response()->json([
                'meta' => [
                    'status' => 'Success',
                ],
                // 'data' => [
                //     'penjualan' => $penjualan,
                //     'penjualan_detail' => $penjualan_detail
                // ]
            ], 200);

            foreach ($request->data as $item) {
                $Product_id = Products::where('nama', $item['nama_barang'])->get();
                // return response()->json(empty($Product_id));
                // return response()->json($Product_id);
                if (empty($Product_id)) {
                    $product = new Products();
                    $product->id_pembelian = $pembelian->id;
                    $product->nama = (int) $item['nama_barang'];

                    $product->harga = (int) $item['harga_beli'];
                    $product->kategori = $item['kategori'];
                    $product->stok = (int) $item['jumlah_barang'];
                    $product->save();
                } else {
                    return response()->json($request->all());
                    $Product_id->id_pembelian = $pembelian->id;
                    $Product_id->nama = $item['nama_barang'];
                    $Product_id->harga = (int) $item['harga_beli'];
                    $Product_id->kategori = $item['kategori'];
                    $Product_id->stok = (int) $item['jumlah_barang'] + $Product_id->stok;
                    $Product_id->save();
                    // return response()->json(empty($Product_id));
                }

                // UNTUK PRODUCT DI LOOP, PEMBELIAN TIDAK


            }
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
}
