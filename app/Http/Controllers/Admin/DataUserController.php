<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {
        return view('pages.admin.data-user.index', [
            'title' => 'Data Users', 
            'act' => 'users'
        ]);
    }
}
