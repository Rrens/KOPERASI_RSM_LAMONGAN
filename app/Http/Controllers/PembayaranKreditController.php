<?php

namespace App\Http\Controllers;

use App\Models\lap_anggota;
use App\Models\lap_anggota_detail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PembayaranKreditController extends Controller
{
    public function index()
    {
        $active = 'kredit';
        $data = User::where('credit', '>', 0)
            ->select('id', 'name', 'poin', 'credit', 'phone', 'address')
            ->get();
        return view('page.pembayaran-kredit', compact('active', 'data'));
    }

    public function get_user_id($id)
    {
        $data = User::where('id', $id)->select('name', 'id', 'address', 'credit')->first();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {
            // return response()->json($request->data['jumlah_bayar']);
            $user = User::findOrFail($request->data['id_anggota']);
            $user->credit -= $request->data['jumlah_bayar'];
            $user->save();
            $lap_anggota = lap_anggota::whereDate('tanggal', Carbon::now()->today())->first();
            if (empty($lap_anggota)) {
                $lap_anggota = new lap_anggota();
                $lap_anggota->tanggal = Carbon::now();
                // return response()->json($lap_anggota);
            }
            $lap_anggota->save();
            $lap_anggota_detail = new lap_anggota_detail();
            $lap_anggota_detail->id_lap_anggota = $lap_anggota->id;
            $lap_anggota_detail->id_user = $user->id;
            $lap_anggota_detail->tanggal = Carbon::now()->toDateString();
            $lap_anggota_detail->credit_masuk = $request->data['jumlah_bayar'];
            $lap_anggota_detail->save();

            return response()->json([
                'meta' => [
                    'status' => 'Success',
                ],
            ], 200);
            // return response()->json($user);
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
