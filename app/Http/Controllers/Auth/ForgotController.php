<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotController extends Controller
{
    public function index()
    {
        return view('pages.auth.forgot', [
            'judul' => 'Halaman lupa password',
        ]);
    }
}
