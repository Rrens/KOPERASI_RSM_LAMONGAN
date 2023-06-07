<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('page.admin');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
