<?php

namespace App\Http\Controllers;

use App\Models\lap_pembelian;
use App\Models\Pembelian;
use App\Models\pembelian_details;
use App\Models\Products;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $active = 'pembelian';
        // $data = Pembelian::with('product_to_pembelian')->get();
        $data = Pembelian::all();
        // dd($data);
        $product = Products::all();
        $pembelian_detail = pembelian_details::with('product')->get();
        return view('page.pembelian', compact('data', 'product', 'pembelian_detail', 'active'));
    }

    public function get_product($nama)
    {
        $product = Products::where('nama', $nama)->first();
        return response()->json($product);
    }

    public function get_pembelian_detail($id)
    {
        $pembelian_detail = DB::table('pembelian_detail as pd')
            ->join('pembelian as p', 'p.id', '=', 'pd.id_pembelian')
            ->join('products as pr', 'pr.id', '=', 'pd.id_product')
            ->where('p.id', $id)
            ->select(
                'pr.nama as nama_barang',
                'pr.kategori as kategori_barang',
                'pd.jumlah_barang',
                'p.keterangan',
                'pd.harga_beli',
                'pd.harga_jual',
                'p.total_bayar',
                'pd.id as id_pembelian_detail'
            )
            ->get();



        // $pembelian_detail = pembelian_details::where('id_pembelian', $id)->get();
        return response()->json($pembelian_detail);
    }

    public function store(Request $request)
    {
        try {
            // return response()->json($request->all());
            $data = collect($request->data);
            $pembelian = new Pembelian();
            $pembelian->total_bayar = $data->sum('total_harga');
            $pembelian->jumlah_barang = $data->sum('jumlah_barang');
            $pembelian->keterangan = $request->data[0]['keterangan'];
            $pembelian->save();

            $lap_pembelian = new lap_pembelian();
            $lap_pembelian->id_pembelian = $pembelian->id;
            $lap_pembelian->barang_dibeli = $pembelian->jumlah_barang;
            $lap_pembelian->pengeluaran = $pembelian->total_bayar;
            $lap_pembelian->keterangan = $pembelian->keterangan;
            $lap_pembelian->tanggal = Carbon::now();

            $lap_pembelian->save();

            $group_data = collect($request->data)->groupBy('nama_barang');

            foreach ($group_data as $item) {

                $nama_produk = $item->first()['nama_barang'];
                $harga = (int) $item->first()['harga_jual'];
                $kategori = $item->first()['kategori'];
                $stok = (int) $item->sum('jumlah_barang');

                $checkSameProduct = Products::where('nama', $nama_produk)->first();

                if (empty($checkSameProduct)) {
                    $product = new Products();
                    $product->nama = $nama_produk;
                    $product->harga = $harga;
                    $product->kategori = $kategori;
                    $product->stok = $stok;
                    $product->save();

                    $pembelian_details = new pembelian_details();
                    $pembelian_details->id_pembelian = $pembelian->id;
                    $pembelian_details->id_product  = $product->id;
                    $pembelian_details->harga_beli = $item->first()['harga_beli'];
                    $pembelian_details->harga_jual = $harga;
                    $pembelian_details->jumlah_barang = $stok;
                    $pembelian_details->save();
                } else {
                    $checkSameProduct->nama = $nama_produk;
                    $checkSameProduct->harga = $harga;
                    $checkSameProduct->kategori = $kategori;
                    $checkSameProduct->stok = $stok + $checkSameProduct->stok;
                    $checkSameProduct->save();

                    $pembelian_details = new pembelian_details();
                    $pembelian_details->id_pembelian = $pembelian->id;
                    $pembelian_details->id_product  = $checkSameProduct->id;
                    $pembelian_details->harga_beli = $item->first()['harga_beli'];
                    $pembelian_details->harga_jual = $harga;
                    $pembelian_details->jumlah_barang = $stok;
                    $pembelian_details->save();
                }
            }

            return response()->json([
                'meta' => [
                    'status' => 'Success',
                ],
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

    public function update(Request $request)
    {
        try {
            $data = collect($request->data);

            $pembelian = Pembelian::findOrFail($data[0]['id_pembelian']);
            $pembelian->total_bayar = $data->sum('total_harga');
            $pembelian->jumlah_barang = $data->sum('jumlah_barang');
            $pembelian->keterangan = $data->first()['keterangan'];
            $pembelian->save();
            // return response()->json($pembelian);

            $lap_pembelian = lap_pembelian::where('id_pembelian', $pembelian->id)->first();
            $lap_pembelian->id_pembelian = $pembelian->id;
            $lap_pembelian->barang_dibeli = $pembelian->jumlah_barang;
            $lap_pembelian->pengeluaran = $pembelian->total_bayar;
            $lap_pembelian->keterangan = $pembelian->keterangan;
            $lap_pembelian->save();

            foreach ($data->groupBy('nama_barang') as $item) {

                $nama_produk = $item->first()['nama_barang'];
                $harga = (int) $item->first()['harga_jual'];
                $kategori = $item->first()['kategori'];
                $stok = (int) $item->first()['jumlah_barang'];
                // return response()->json($harga);

                $checkSameProduct = Products::where('nama', $nama_produk)->first();

                if (empty($checkSameProduct)) {
                    $product = new Products();
                    $product->nama = $nama_produk;
                    $product->harga = $harga;
                    $product->kategori = $kategori;
                    // $product->stok = $stok;
                    $product->save();

                    $pembelian_details = new pembelian_details();
                    $pembelian_details->id_pembelian = $pembelian->id;
                    $pembelian_details->id_product  = $product->id;
                    $pembelian_details->harga_beli = $item->first()['harga_beli'];
                    $pembelian_details->harga_jual = $harga;
                    $pembelian_details->jumlah_barang = $stok;
                    $pembelian_details->save();
                } else {
                    $checkSameProduct->nama = $nama_produk;
                    $checkSameProduct->harga = $harga;
                    $checkSameProduct->kategori = $kategori;
                    // $checkSameProduct->stok = $stok + $checkSameProduct->stok;
                    // return response()->json($checkSameProduct);
                    $checkSameProduct->save();

                    $checkSameIDProduct = pembelian_details::where('id_product', $checkSameProduct->id)->first();

                    if (empty($checkSameIDProduct)) {
                        $pembelian_details = new pembelian_details();
                        $pembelian_details->id_pembelian = $pembelian->id;
                        $pembelian_details->id_product  = $checkSameProduct->id;
                        $pembelian_details->harga_beli = $item->first()['harga_beli'];
                        $pembelian_details->harga_jual = $harga;
                        $pembelian_details->jumlah_barang = $stok;
                        $pembelian_details->save();
                    } else {
                        // $checkSameIDProduct->id_pembelian = $pembelian->id;
                        $checkSameIDProduct->id_product  = $checkSameProduct->id;
                        $checkSameIDProduct->harga_beli = $item->first()['harga_beli'];
                        $checkSameIDProduct->harga_jual = $harga;
                        $checkSameIDProduct->jumlah_barang = $stok;
                        $checkSameIDProduct->save();
                    }
                }
            }

            $pembelian_details_for_product = pembelian_details::select('id_product', DB::raw('SUM(jumlah_barang) as jumlah_barang'))
                ->groupBy('id_product')
                ->get();


            // $pembelian_details_for_product = pembelian_details::all();
            foreach ($pembelian_details_for_product as $item) {
                $product = Products::findOrFail($item->id_product);
                $product->stok = (int) $item->jumlah_barang;
                $product->save();
            }
            // return response()->json($item);

            return response()->json([
                'meta' => [
                    'status' => 'Success',
                ],
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
}
