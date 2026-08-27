@extends('layouts.guest')

@section('title', 'Registrasi')

@section('content')
<div class="w-full max-w-md">
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-brand text-3xl font-extrabold text-white shadow-glow">L</div>
        <h1 class="text-3xl font-extrabold tracking-tight text-deep-space-600">LIMS Lite</h1>
        <p class="mt-1 text-sm text-deep-space-600/70">Buat Akun Baru</p>
    </div>

    <div class="card p-8">
        <h2 class="mb-6 text-xl font-bold text-deep-space-600">Registrasi</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="label" for="nama">Nama Lengkap</label>
                <input class="input" id="nama" name="nama" type="text" placeholder="Nama lengkap" required>
            </div>
            <div class="mb-4">
                <label class="label" for="email">Email</label>
                <input class="input" id="email" name="email" type="email" placeholder="nama@mail.ugm.ac.id" required>
            </div>
            <div class="mb-4">
                <label class="label" for="role">Peran</label>
                <select class="input" id="role" name="role" required>
                    <option value="">Pilih peran…</option>
                    <option>Mahasiswa</option>
                    <option>Dosen</option>
                    <option>Peneliti</option>
                    <option>Admin Lab</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="label" for="password">Password</label>
                <input class="input" id="password" name="password" type="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-primary w-full">Daftar</button>
        </form>

        <p class="mt-6 text-center text-sm text-deep-space-600/70">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-blue-green-400 hover:underline">Masuk</a>
        </p>
    </div>
</div>
@endsection
