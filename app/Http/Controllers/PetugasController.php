<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        return view('admin.datamaster.petugas');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_role' => 'required|integer'
        ]);

        if ($request->hasFile('foto_profile')) {
            $imagePath = $request->file('foto_profile')->store('profile_images', 'public');
            $validate['foto_profile'] = $imagePath;
        }

        try {
            $validate['password'] = Hash::make($validate['password']);
            $validate['id_role'] = 2;

            UserModel::create($validate);
            return redirect()->back()->with('success', 'Petugas berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Petugas gagal ditambahkan');
        }
    }

    public function delete(string $id)
    {
        try {
            UserModel::destroy($id);
            return redirect()->back()->with('success', 'Petugas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Petugas gagal dihapus');
        }
    }
}
