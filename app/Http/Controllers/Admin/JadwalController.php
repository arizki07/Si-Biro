<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        return view('pages.admin.data-jadwal.index', [
            'title' => 'Data Jadwal', 
            'act' => 'jadwal'
        ]);
    }
}
