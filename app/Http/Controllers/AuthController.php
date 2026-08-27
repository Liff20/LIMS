<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\DataProvider;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = strtolower(trim($request->input('username')));
        $password = $request->input('password');

        $user = collect(DataProvider::users())->first(function ($u) use ($username) {
            return strtolower($u['username']) === $username;
        });

        // Iterasi 1 (dummy): password default untuk semua akun adalah "password123".
        if ($user && $password === 'password123') {
            session([
                'user_name' => $user['nama'],
                'user_username' => $user['username'],
                'user_role' => $user['role'],
                'user_id' => $user['id'],
            ]);

            if ($user['unit_id']) {
                session(['selected_unit' => (int) $user['unit_id']]);
            }

            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user['nama'] . '!');
        }

        return back()->withErrors(['username' => 'Username atau password salah. (Dummy: gunakan password "password123")']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function pilihUnit()
    {
        return view('auth.pilih-unit', ['units' => DataProvider::units()]);
    }

    public function selectUnit(Request $request)
    {
        $request->validate(['unit_id' => 'required|integer']);
        session(['selected_unit' => (int) $request->input('unit_id')]);

        return redirect()->back()->with('success', 'Unit berhasil dipilih.');
    }

    public function logout()
    {
        return redirect()->route('login');
    }
}
