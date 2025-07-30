<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.setting.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed|different:current_password',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $updateData = [
            'nama_lengkap' => $request->nama_lengkap,
            'updated_at' => now()
        ];

        // Password update
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah']);
            }
            $updateData['password'] = Hash::make($request->password);
        }

        // Update menggunakan Query Builder
        DB::table('users')
            ->where('id', $user->id)
            ->update($updateData);

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
