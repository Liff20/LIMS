<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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

        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            session([
                'user_name' => $user->name,
                'user_username' => $user->username,
                'user_role' => $user->role,
                'user_id' => $user->id,
            ]);

            if ($user->unit_id) {
                session(['selected_unit' => (int) $user->unit_id]);
            }

            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return back()->withErrors(['username' => 'Username atau password salah. (Password default: "password123")']);
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
        Auth::logout();
        session()->flush();

        return redirect()->route('login');
    }
}
