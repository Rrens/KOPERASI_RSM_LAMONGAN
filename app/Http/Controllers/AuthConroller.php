<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthConroller extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
}
