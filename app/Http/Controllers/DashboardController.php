<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
// <<<<<<< login
        // dd(Auth::user());
        // dd(Session::all());
// =======

        $role = RoleModel::count();
        return view('dashboard', [
            'role' => $role,
            'act' => 'dashboard',
        ]);
// >>>>>>> main
//         return view('dashboard', [
//             'title' => 'Dashboard',
//             'act' => 'dashboard',
//             'role' => $role
//         ]);
    }
}
