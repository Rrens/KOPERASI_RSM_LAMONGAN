<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    public function index()
    {
        $active = 'anggota';
        $data = User::where('role', 1)->get();
        // foreach ($data as $item) {
        //     $item['kode'] = $item['id'];
        //     $item->kode = $item->id;
        //     unset($item['id']); # code...
        // }


        // dd($data, $forID);
        return view('page.anggota', compact('data', 'active'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nik' => 'required|min:16|integer',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required_if:1,0',
            'nik' => 'required',
            'telp' => 'required',
            'status_nikah' => 'required_if:1,0',
            'pin' => 'required|min:6',
            'rpassword' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return redirect()->route('anggota.index')->withInput();
        }

        if ($request->pin != $request->rpassword) {
            Alert::toast('Password dan re-type Password tidak sama', 'error');
            return redirect()->route('anggota.index')->withInput();
        }

        try {
            $user_for_creating_database = new User();
            // $user_for_creating_database->id = $request->id;
            $user_for_creating_database->nik = $request->nik;
            $user_for_creating_database->name = $request->nama_lengkap;
            $user_for_creating_database->pin = $request->pin;
            $user_for_creating_database->phone = $request->telp;
            $user_for_creating_database->tempat_lahir = $request->tempat_lahir;
            $user_for_creating_database->tanggal_lahir = $request->tanggal_lahir;
            $user_for_creating_database->status_pernikahan = $request->status_nikah;
            $user_for_creating_database->role = 1;
            $user_for_creating_database->gender = $request->jenis_kelamin;
            $user_for_creating_database->address = $request->alamat;
            // dd($user_for_creating_database);
            $user_for_creating_database->save();
            Alert::toast('Success Add anggota' . $user_for_creating_database->name, 'success');
            return redirect()->route('anggota.index');
        } catch (Exception $error) {
            Alert::error('error', $error->getMessage());
            return redirect()->route('anggota.index')->withInput();
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|min:16|integer',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required_if:1,0',
            'nik' => 'required',
            'telp' => 'required',
            'status_nikah' => 'required_if:1,0',
            'pin' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return redirect()->route('anggota.index')->withInput();
        }

        $user = User::findOrFail($request->id_anggota);
        // dd($user);
        try {
            $user->nik = $request->nik;
            $user->name = $request->nama_lengkap;
            $user->pin = $request->pin;
            $user->phone = $request->telp;
            $user->tempat_lahir = $request->tempat_lahir;
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->status_pernikahan = $request->status_nikah;
            $user->role = 1;
            $user->gender = $request->jenis_kelamin;
            $user->address = $request->alamat;
            $user->save();
            Alert::toast('Success Edit Anggota', 'success');
        } catch (Exception $error) {
            Alert::error('error', $error->getMessage());
        }


        return redirect()->route('anggota.index');
    }

    public function delete(Request $request)
    {

        try {
            $user = User::findOrFail($request->id_anggota);
            $user->delete();
            Alert::toast('Success Delete Anggota', 'success');
        } catch (Exception $error) {
            Alert::error('error', $error->getMessage());
        }
        return redirect()->route('anggota.index');
    }
}
