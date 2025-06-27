<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Memproses percobaan login.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba lakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika berhasil, arahkan ke halaman utama
            return redirect()->intended('/'); 
        }

        // 3. Jika gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau Password yang dimasukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Memproses logout.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman utama setelah logout
        return redirect('/');
    }
}