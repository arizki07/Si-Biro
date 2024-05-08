<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {

        $role = RoleModel::count();
        $user = User::count();
        return view('dashboard', [
            'act' => 'dashboard',
            'judul' => 'Halaman Utama',
            'role' => $role,
            'user' => $user,
        ]);
    }
}
