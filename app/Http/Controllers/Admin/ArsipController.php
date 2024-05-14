<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index()
    {
        return view('pages.admin.data-arsip.index', [
            'act' => 'arsip',
        ]);
    }
}
