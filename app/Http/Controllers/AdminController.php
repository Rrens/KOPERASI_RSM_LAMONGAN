<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        $active = 'admin';
        $data = User::where('role', 0)->get();
        $data_kasir = User::where('role', 1)->get();
        // foreach ($data as $item) {
        //     $item['kode'] = $item['id'];
        //     $item->kode = $item->id;
        //     unset($item['id']); # code...
        // }


        // dd($data, $forID);
        return view('page.admin', compact('data', 'data_kasir', 'active'));
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
            return redirect()->route('admin.index')->withInput();
        }

        if ($request->pin != $request->rpassword) {
            Alert::toast('Password dan re-type Password tidak sama', 'error');
            return redirect()->route('admin.index')->withInput();
        }

        try {
            $user_for_creating_database = new User();
            // $user_for_creating_database->id = $request->id;
            $user_for_creating_database->nik = $request->nik;
            $user_for_creating_database->name = $request->nama_lengkap;
            $user_for_creating_database->password = Hash::make($request->pin);
            $user_for_creating_database->phone = $request->telp;
            $user_for_creating_database->tempat_lahir = $request->tempat_lahir;
            $user_for_creating_database->tanggal_lahir = $request->tanggal_lahir;
            $user_for_creating_database->status_pernikahan = $request->status_nikah;
            $user_for_creating_database->role = $request->jenis_user;
            $user_for_creating_database->gender = $request->jenis_kelamin;
            $user_for_creating_database->address = $request->alamat;
            $user_for_creating_database->tanggal = Carbon::now();
            // dd($user_for_creating_database);
            $user_for_creating_database->save();
            if ($request->jenis_user == 0) {
                Alert::toast('Success Add Admin', 'success');
            } else {
                Alert::toast('Success Add Kasir', 'success');
            }
            return redirect()->route('admin.index');
        } catch (Exception $error) {
            Alert::error('error', $error->getMessage());
            return redirect()->route('admin.index')->withInput();
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
            return redirect()->route('admin.index')->withInput();
        }

        // $user = User::where('kode', $request->id_admin)->first();
        // dd($request->all(), $validator);
        $user = User::findOrFail($request->id_admin);
        // dd($user);
        try {
            $user->nik = $request->nik;
            $user->name = $request->nama_lengkap;
            $user->password = $request->pin;
            $user->phone = $request->telp;
            $user->tempat_lahir = $request->tempat_lahir;
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->status_pernikahan = $request->status_nikah;
            $user->role = $request->jenis_user;
            $user->gender = $request->jenis_kelamin;
            $user->address = $request->alamat;
            $user->save();
            Alert::toast('Success Edit Admin', 'success');
        } catch (Exception $error) {
            Alert::error('error', $error->getMessage());
        }


        return redirect()->route('admin.index');
    }

    public function delete(Request $request)
    {

        try {
            $user = User::findOrFail($request->id_admin);
            $user->delete();
            Alert::toast('Success Delete Admin', 'success');
        } catch (Exception $error) {
            Alert::error('error', $error->getMessage());
        }
        return redirect()->route('admin.index');
    }
}
