<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $role = RoleModel::all();
        return view('pages.admin.data-role.index', [
            'role' => $role,
            'title' => 'Data Role',
            'act' => 'role'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,jamaah,finance,front office,kbih',
        ]);

        $role = new RoleModel();
        $role->role = $request->input('role');
        $role->save();

        return redirect()->route('data.role')->with('success', 'Data Role Berhasil Di Tambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,jamaah,finance,front office,kbih',
        ]);

        $role = RoleModel::findOrFail($id);
        $role->role = $request->input('role');
        $role->save();

        return redirect()->route('data.role')->with('success', 'Data Role Berhasil Di Update');
    }

    public function destroy($id)
    {
        $role = RoleModel::findOrFail($id);
        $role->delete();
        return redirect()->route('data.role')->with('success', 'Data Role Berhasil Di Delete');
    }
}
