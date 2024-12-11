<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function masuk(Request $request)
    {
        $rules = [
            'password' => 'required|string',
            'email' => 'required',
            // 'email' => 'required|email:dns',
        ];
        $throttles = $request->session()->get('throttle', []);
        if (isset($throttles['login']) && $throttles['login'] >= 5) {
            $seconds = now()->diffInSeconds($throttles['expires_at']);
            return back()->with('throttle', __('auth.throttle', ['seconds' => $seconds]));
        }
        // Validasi input
        $request->validate($rules);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with('loginError', 'Login Gagal');
    }

    public function keluar(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/beranda')->with('pesan', 'Berhasil Keluar!');
        } else {
            return redirect('/masuk')->with('pesan', 'Anda belum login!');
        }
    }
}
