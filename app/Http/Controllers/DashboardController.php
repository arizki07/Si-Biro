<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        // dd(Session::all());
        return view('dashboard', [
            'title' => 'Dashboard',
            'act' => 'dashboard'
        ]);
    }
}
