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
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error($validator->messages()->all());
            return redirect()->route('dashboard');
        }
        $data = [
            'name' => $request->name,
            'password' => $request->password
        ];

        if (!Auth::attempt($data)) {
            Session::flash('error', 'Name or Password is wrong');
            Alert::error(
                'error',
                'Name or Password is wrong'
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
