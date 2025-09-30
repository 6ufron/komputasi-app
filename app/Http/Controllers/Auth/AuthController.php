<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    // Menampilkan form login
    public function loginForm()
    {
        return view('auth.loginForm');
    }

    // Menangani proses login.
    public function login(Request $request)
    {
        // Ambil email dan password dari request
        $credentials = $request->only('email', 'password');
    
        // Validasi input awal
        $validated = Validator::make($credentials, [
            'email' => [
                'required',
                'email',
                'max:255', // Batas panjang maksimum untuk email
            ],
            'password' => [
                'required',
                'min:8', // Minimal 8 karakter
                'max:32', // Batas panjang maksimum
                'regex:/[A-Za-z]/', // Harus memiliki huruf
                'regex:/[0-9]/', // Harus memiliki angka
            ],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'password.max' => 'Password tidak boleh lebih dari 32 karakter.',
            'password.regex' => 'Password harus mengandung huruf dan angka.',
        ]);
    
        // Jika validasi gagal, redirect kembali dengan error
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated->errors())->withInput();
        }
    
        // Throttling untuk mencegah brute force
        $email = $request->input('email');
        $throttleKey = 'login|' . $email;
    
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return redirect()->back()->with('error', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $seconds . ' detik.');
        }
    
        // Cek apakah email terdaftar
        $userExists = Auth::where('email', $email)->exists();
    
        // Jika login gagal
        if (!Auth::attempt($credentials)) {
            // Jika email terdaftar, tampilkan error hanya pada password
            if ($userExists) {
                return redirect()->back()
                    ->withErrors(['password' => 'Password yang Anda masukkan salah.'])
                    ->withInput();
            }
    
            // Jika email tidak terdaftar, tampilkan error pada email
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput();
        }
    
        // Jika login berhasil
        $request->session()->regenerate();
        RateLimiter::clear($throttleKey); // Hapus catatan throttle
    
        // Mengarahkan pengguna ke halaman yang dituju
        return redirect()->intended('/');
    }    

    // Menangani logout dan invalidasi session
    public function logout(Request $request)
    {
        // Logout, invalidate session, dan regenerate token
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login');
    }

    // Menampilkan halaman unauthorized
    public function unauthorized()
    {
        return view('auth.403');
    }

    public function register(Request $request)
    {
    $validated = $request->validate([
        'email' => 'required|email|unique:users,email|max:255',
        'password' => 'required|min:8|max:32|regex:/[A-Za-z]/|regex:/[0-9]/',
    ]);

    $user = User::create([
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    Auth::login($user);

    return redirect()->intended('/');
    }

}
