<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            $request->validate([
                'nama' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'id_role' => 'required|exists:t_role,id_role',
                'status' => [
                    'required', Rule::in([1, 2]),
                ],
                'password' => 'required|min:6',
            ]);

            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'id_role' => $request->id_role,
                'otp_register' => null,
                'password' => Hash::make($request->password),
                'status' => $request->status,
            ]);

            return redirect()->route('data.users')->with('success', 'User added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add user: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'nama' => 'required|string',
                'email' => [
                    'required',
                    'email',
                    function ($attribute, $value, $fail) use ($user) {
                        if ($value !== $user->email) {
                            $rule = Rule::unique('users')->ignore($user->id, 'id_user');
                            $validator = Validator::make([$attribute => $value], ['email' => $rule]);

                            if ($validator->fails()) {
                                $fail('The email has already been taken.');
                            }
                        }
                    },
                ],
                'id_role' => 'required|exists:t_role,id_role',
                'status' => [
                    'required',
                    Rule::in([1, 2]),
                ],
                'password' => 'nullable|min:6|confirmed',
            ]);

            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'id_role' => $request->id_role,
                'status' => $request->status,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            return redirect()->route('data.users')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        // Mengambil ID pengguna yang sedang login
        $currentUserId = Auth::id();

        // Mencari pengguna berdasarkan ID yang ingin dihapus
        $user = User::find($id);

        // Jika pengguna tidak ditemukan
        if (!$user) {
            return redirect('/data-users')->with('error', 'Data user tidak ditemukan');
        }

        // Validasi apakah pengguna yang akan dihapus adalah pengguna yang sedang login
        if ($user->id == $currentUserId) {
            return redirect('/data-users')->with('error', 'Anda tidak bisa menghapus pengguna yang sedang login');
        }

        // Jika validasi berhasil, hapus pengguna
        if ($user->delete()) {
            return redirect('/data-users')->with('success', 'Data user berhasil dihapus');
        } else {
            return redirect('/data-users')->with('error', 'Gagal menghapus data user');
        }
    }
}
