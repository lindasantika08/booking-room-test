<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        if ($request->isMethod('get')) {
            return view('auth.login');
        }

        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role user untuk redirect
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard')
                    ->with('success', 'Berhasil login sebagai Admin!');
            } else {
                return redirect()->intended('/user/dashboard')
                    ->with('success', 'Berhasil login sebagai User!');
            }
        }

        return back()->withErrors([
            'email' => 'Terjadi masalah saat login. Silakan hubungi administrator.',
        ])->onlyInput('email');
    }


    public function register(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.register');
        }

        // proses register nanti bisa ditambah
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda sudah logout.');
    }
}