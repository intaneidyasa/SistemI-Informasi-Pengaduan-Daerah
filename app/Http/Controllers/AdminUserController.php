<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Menampilkan Halaman Manajemen Pengguna
    public function index()
    {
        $users = DB::table('users')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.users', compact('users'));
    }

    // Menampilkan Form Tambah User
    public function create()
    {
        return view('admin.create_user');
    }

    // Menyimpan User Baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role'     => 'required|in:admin,masyarakat',
        ]);

        DB::table('users')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Fungsi Hapus User untuk Admin
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User tidak ditemukan.');
        }

        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role'  => 'required|in:admin,masyarakat',
        ]);

        DB::table('users')->where('id', $id)->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }
}