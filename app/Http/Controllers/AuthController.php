<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        $title = 'Sistem Manajemen Keuangan Mirafa';
        return view('landing.index', compact('title'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role->role_code === 'KPS') {
                return redirect()->route('dashboard.admin')->with('success', 'Berhasil login sebagai Admin KPS');
            } elseif ($user->role->role_code === 'BND') {
                return redirect()->route('dashboard.petugas')->with('success', 'berhasil login sebagai petugas bendahara');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.'
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect()->route('home');
    }
}
