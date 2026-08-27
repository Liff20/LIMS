@extends('layouts.guest')

@section('title', 'Pilih Unit')

@section('content')
<div class="w-full max-w-2xl">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold tracking-tight text-deep-space-600">Pilih Unit Kerja</h1>
        <p class="mt-2 text-sm text-deep-space-600/70">Pilih laboratorium/unit tempat Anda bertugas</p>
    </div>

    <form method="POST" action="{{ route('unit.select') }}">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach ($units as $unit)
                <label class="group cursor-pointer">
                    <input type="radio" name="unit_id" value="{{ $unit['id'] }}" class="peer sr-only" @checked($loop->first)>
                    <div class="card h-full p-5 transition group-hover:shadow-glow peer-checked:border-blue-green-400 peer-checked:bg-white/90 peer-checked:ring-2 peer-checked:ring-blue-green-400">
                        <div class="mb-2 flex items-center gap-2">
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-brand text-white">
                                <x-icon name="flask" class="h-5 w-5" />
                            </div>
                            <span class="badge-blue">{{ $unit['kode'] }}</span>
                        </div>
                        <div class="font-semibold text-deep-space-600">{{ $unit['nama'] }}</div>
                        <div class="mt-1 text-xs text-deep-space-600/60">{{ $unit['lokasi'] }}</div>
                    </div>
                </label>
            @endforeach
        </div>

        <button type="submit" class="btn-primary mt-6 w-full">Lanjutkan ke Dashboard</button>
    </form>
</div>
@endsection
