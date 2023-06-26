<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardConroller extends Controller
{
    public function index()
    {
        $active = 'dashboard';
        return view('page.dashboard', compact('active'));
    }
}
