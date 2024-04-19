<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {
        $roles = RoleModel::all();
        $users = User::all();
        return view('pages.admin.data-user.index', [
            'title' => 'Data Users',
            'act' => 'users',
            'roles' => $roles,
            'users' => $users,
        ]);
    }

    public function add(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string',
                'email' => 'required|email|unique:users',
                'id_role' => 'required|exists:t_role,id_role',
                'password' => 'required|string|min:8',
                'status' => 'required|string'
            ]);

            var_dump($validatedData);
            // Buat user baru
            $user = new User();
            $user->nama = $validatedData['nama'];
            $user->email = $validatedData['email'];
            $user->id_role = $validatedData['id_role'];
            $user->password = bcrypt($validatedData['password']);
            $user->status = $validatedData['status'];
            $user->save();

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
