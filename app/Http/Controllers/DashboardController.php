<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $role = RoleModel::count();
        return view('dashboard', [
            'title' => 'Dashboard',
            'act' => 'dashboard',
            'role' => $role
        ]);
    }
}
