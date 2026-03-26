<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input (optional tapi disarankan)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($data, $remember)) {
            $request->session()->regenerate(); // regenerasi session
            return redirect()->intended('/finance'); // redirect ke halaman yang dimaksud
        }

        return back()->with('error', 'Email atau Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();                     // Logout user
        $request->session()->invalidate();  // Hapus session
        $request->session()->regenerateToken(); // Regenerate CSRF token
        return redirect('/login');          // Kembali ke login
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login'); // redirect otomatis ke login jika belum login
        }
    }

    public function index()
    {
        // Jika user sudah login, langsung redirect ke /finance
        if (Auth::check()) {
            return redirect('/finance');
        }

        return view('login'); // Blade login
    }
}