<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->canAccessContent() && !$user->canAccessFinance()) {
                return redirect()->route('admin.konten.index');
            }
            return redirect()->route('admin.keuangan.index');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
            'admin_role' => 'nullable|string',
        ]);

        $emailOrId = trim($credentials['email']);
        $password = $credentials['password'];
        $remember = $request->boolean('remember', true);

        // Map short emails or IDs if entered
        $email = $emailOrId;
        if (!str_contains($email, '@')) {
            $email = $email . '@alfattah-ongkaw3.id';
        }

        // Attempt login
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember) ||
            Auth::attempt(['email' => $emailOrId, 'password' => $password], $remember)) {

            $request->session()->regenerate();
            $user = Auth::user();

            // Log activity
            AuditLog::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'action' => 'Login Portal Admin',
                'module' => 'Autentikasi',
                'details' => "Pengurus berhasil masuk dengan peran: {$user->role} ({$user->title})",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Route based on role selection or user wewenang
            $requestedRole = $request->input('admin_role');

            if ($requestedRole === 'dakwah' && $user->canAccessContent()) {
                return redirect()->intended(route('admin.konten.index'))->with('success', "Ahlan wa sahlan, {$user->name}. Selamat datang di Dashboard Konten & Syiar.");
            } elseif ($requestedRole === 'keuangan' && $user->canAccessFinance()) {
                return redirect()->intended(route('admin.keuangan.index'))->with('success', "Assalamu'alaikum, {$user->name}. Selamat datang di Dashboard Keuangan & Kas.");
            }

            if ($user->role === 'dakwah') {
                return redirect()->intended(route('admin.konten.index'));
            } else {
                return redirect()->intended(route('admin.keuangan.index'));
            }
        }

        return back()->withErrors([
            'email' => 'Kredensial atau kata sandi pengurus tidak sesuai dengan basis data BKM.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            AuditLog::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'action' => 'Logout Portal Admin',
                'module' => 'Autentikasi',
                'details' => "Pengurus keluar dari sesi",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Sesi portal admin telah diakhiri dengan aman.');
    }
}
