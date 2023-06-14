<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
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
        return response()->json($request->all());
    }

    // public function
}
