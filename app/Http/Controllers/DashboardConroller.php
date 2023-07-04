<?php

namespace App\Http\Controllers;

use App\Models\Penjualan_details;
use Illuminate\Http\Request;

class DashboardConroller extends Controller
{
    public function index()
    {
        $active = 'dashboard';
        // $grafik =
        $data = Penjualan_details::with('product')->get();
        // dd($data);
        return view('page.dashboard', compact('active', 'data'));
    }
}
