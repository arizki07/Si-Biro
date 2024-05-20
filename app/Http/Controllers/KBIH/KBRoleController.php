<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use Illuminate\Http\Request;

class KBRoleController extends Controller
{
    public function index()
    {
        $role = RoleModel::all();
        return view('pages.kbih.kbih-role.index', [
            'act' => 'KBRole',
            'title' => 'Data Role KBIH',
            'role' => $role,
        ]);
    }
}
