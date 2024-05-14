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
        $validator = Validator::make($request->all(), [
            'nama_role' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }

        $role = new RoleModel();
        $role->nama_role = $request->input('nama_role');
        $role->save();

        return redirect()->route('data.role')->with('success', 'Data Role Berhasil Di Tambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required|string',
        ]);

        $role = RoleModel::findOrFail($id);
        $role->nama_role = $request->input('nama_role');
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
