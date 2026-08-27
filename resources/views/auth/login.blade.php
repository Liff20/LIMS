@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="w-full max-w-md">
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-brand text-3xl font-extrabold text-white shadow-glow">L</div>
        <h1 class="text-3xl font-extrabold tracking-tight text-deep-space-600">LIMS Lite</h1>
        <p class="mt-1 text-sm text-deep-space-600/70">Laboratory Inventory Management System</p>
    </div>

    <div class="card p-8">
        <h2 class="mb-6 text-xl font-bold text-deep-space-600">Masuk ke Akun Anda</h2>

        @if ($errors->any())
            <div class="mb-4 rounded-2xl border border-red-200 bg-red-50/80 px-4 py-3 text-sm font-medium text-red-600 backdrop-blur">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="mb-4">
                <label class="label" for="username">Username</label>
                <input class="input" id="username" name="username" type="text" value="{{ old('username') }}" placeholder="Masukkan username" required autofocus>
            </div>
            <div class="mb-6">
                <label class="label" for="password">Password</label>
                <input class="input" id="password" name="password" type="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-primary w-full">Masuk</button>
        </form>

        <p class="mt-4 rounded-2xl bg-blue-green-50/70 px-4 py-3 text-xs text-deep-space-600/70">
            <strong>Demo:</strong> username <code class="font-semibold">admin</code>, password <code class="font-semibold">password123</code>
        </p>

        <p class="mt-6 text-center text-sm text-deep-space-600/70">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-blue-green-400 hover:underline">Daftar di sini</a>
        </p>
    </div>

    <p class="mt-6 text-center text-xs text-deep-space-600/50">© {{ date('Y') }} FKG UGM — Stok Opname Bahan Laboratorium</p>
</div>
@endsection
