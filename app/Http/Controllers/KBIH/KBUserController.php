<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Http\Request;

class KBUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = RoleModel::all();
        return view('pages.kbih.kbih-user.index', [
            'act' => 'KBUser',
            'title' => 'Data User KBIH',
            'users' => $users,
            'roles' => $roles
        ]);
    }
}
