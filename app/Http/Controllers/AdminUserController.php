<?php

namespace App\Http\Controllers;

use App\Models\UserAdminn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        if (!session('data')) {
            return redirect()->route('log1n')->with('error', 'Anda harus login terlebih dahulu');
        }
        return view('admin/user/index', [
            'title' => 'User Management | Jihadul Haq',
            'page' => 'User Management',
            'path' => 'User Management',
            'role' => session('data')->role,

            'user' => UserAdminn::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'string|required',
                'username' => 'string|required|unique:data_user,username',
                'pass' => 'string|required',
                'role' => 'string|required',
            ]);

            $user = new UserAdminn();

            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->p4ssw0rd = Hash::make($request->pass);
            $user->role = $request->role;

            $user->save();

            return back()->with('success', 'Berhasil menambahkan user baru');
        } catch (ValidationException $e) {
            return back()->with('error', 'Gagal menambahkan data, username telah digunakan atau terdapat kesalahan lain pada form user baru.');
        } catch (\Exception $err) {
            return back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function edit(Request $request, $id)
    {
        if (!session('data')) {
            return redirect()->route('log1n')->with('error', 'Anda harus login terlebih dahulu');
        }
        return view('admin/user/edit', [
            'title' => 'Edit User | Jihadul Haq',
            'page' => 'Edit Data User',
            'path' => 'Edit Data User',
            'role' => session('data')->role,

            'user' => UserAdminn::findOrFail($id)
        ]);
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'string|required',
                'nama' => 'string|required',
                'pass' => 'string|nullable',
                'role' => 'string|required',
            ]);

            $user = UserAdminn::findOrFail($request->id);

            $user->nama = $request->nama;
            if ($request->pass != '') {
                $user->p4ssw0rd = Hash::make($request->pass);
            }
            $user->role = $request->role;

            $user->save();

            return redirect()->route('admin.user.index')->with('success', 'Berhasil memperbarui data');
        } catch (\Exception $err) {
            return back()->with('error', 'Gagal memperbarui data');
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'string|required',
            ]);

            $user = UserAdminn::findOrFail($request->id);

            if (!$user) {
                return back()->with('error', 'Data tidak ditemukan');
            }

            $user->delete();

            return back()->with('success', 'Berhasil menghapus data');
        } catch (\Exception $err) {
            return back()->with('error', 'Gagal menghapus data');
        }
    }
}
