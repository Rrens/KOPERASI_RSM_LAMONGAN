<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthConroller extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }
        return view('auth.login');
    }

    public function post_login(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'pin' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error($validator->messages()->all());
            return redirect()->route('login');
        }
        $data = [
            'name' => $request->name,
            'password' => $request->pin
        ];
        // dd(!Auth::attempt());

        if (!Auth::attempt($data)) {
            Session::flash('error', 'Name or pin is wrong');
            Alert::error(
                'error',
                'Name or pin is wrong'
            );
            return redirect()->route('login');
        }

        return redirect()->route('dashboard.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
