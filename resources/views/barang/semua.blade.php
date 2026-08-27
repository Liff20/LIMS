@extends('layouts.app')

@section('title', 'Semua Alat & Bahan')
@section('page-title', 'Semua Alat & Bahan')
@section('page-subtitle', 'Daftar seluruh alat & bahan')

@section('content')
    <div class="card flex flex-col items-center justify-center px-6 py-20 text-center">
        <div class="mb-4 flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-brand text-white shadow-glow">
            <x-icon name="cube" class="h-10 w-10" />
        </div>
        <h3 class="text-xl font-bold text-deep-space-600">Dalam Pengembangan</h3>
        <p class="mt-2 max-w-md text-sm text-deep-space-600/70">
            Halaman "Semua Alat & Bahan" sedang dalam tahap pengembangan. Fitur ini akan segera hadir pada iterasi berikutnya.
        </p>
        <span class="badge-amber mt-4">Segera hadir</span>
    </div>
@endsection
