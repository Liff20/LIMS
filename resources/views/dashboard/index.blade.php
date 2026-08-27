@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan stok opname bahan laboratorium')

@section('content')
    {{-- Flash message --}}
    @if (session('success'))
        <div class="mb-4 flex items-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-700">
            <x-icon name="check" class="h-5 w-5" />
            {{ session('success') }}
        </div>
    @endif

    {{-- Kartu ringkasan --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wide text-deep-space-600/60">Total Unit Lab</div>
                    <div class="mt-1 text-3xl font-extrabold text-deep-space-600">{{ $ringkasan['total_unit'] }}</div>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-brand text-white shadow-glow">
                    <x-icon name="flask" class="h-6 w-6" />
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wide text-deep-space-600/60">Jenis Barang</div>
                    <div class="mt-1 text-3xl font-extrabold text-deep-space-600">{{ $ringkasan['total_jenis_barang'] }}</div>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-accent text-[#61460c] shadow-md">
                    <x-icon name="cube" class="h-6 w-6" />
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wide text-deep-space-600/60">Total Barang</div>
                    <div class="mt-1 text-3xl font-extrabold text-deep-space-600">{{ $ringkasan['total_barang'] }}</div>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-green-400 text-white shadow-md">
                    <x-icon name="box" class="h-6 w-6" />
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wide text-deep-space-600/60">Expired &lt; 90 Hari</div>
                    <div class="mt-1 text-3xl font-extrabold {{ $ringkasan['expired_dekat'] > 0 ? 'text-orange-princeton' : 'text-deep-space-600' }}">{{ $ringkasan['expired_dekat'] }}</div>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-flame text-[#61460c] shadow-md">
                    <x-icon name="calendar" class="h-6 w-6" />
                </div>
            </div>
        </div>
    </div>

    {{-- Jenis barang + daftar --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-1">
            <div class="card p-5">
                <h3 class="mb-4 flex items-center gap-2 font-bold text-deep-space-600">
                    <x-icon name="cube" class="h-5 w-5 text-blue-green-400" />
                    Jenis Alat/Bahan
                </h3>
                <div class="space-y-2">
                    @foreach ($jenis as $j)
                        <a href="{{ route('dashboard', ['jenis' => $j['nama']]) }}"
                           class="flex items-center justify-between rounded-2xl border border-white/60 bg-white/40 px-4 py-3 transition hover:bg-white/70">
                            <span class="text-sm font-medium text-deep-space-600">{{ $j['nama'] }}</span>
                            <x-icon name="chevron-right" class="h-4 w-4 text-deep-space-600/40" />
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="card p-5">
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="flex items-center gap-2 font-bold text-deep-space-600">
                        <x-icon name="box" class="h-5 w-5 text-blue-green-400" />
                        Daftar Alat/Bahan
                    </h3>
                    <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-2">
                        <input type="text" name="q" value="{{ $filters['q'] }}" placeholder="Cari barang…" class="input !w-44 !py-2 !text-xs">
                        <select name="jenis" class="input !w-40 !py-2 !text-xs" onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            @foreach ($jenis as $j)
                                <option value="{{ $j['nama'] }}" @selected($filters['jenis'] === $j['nama'])>{{ $j['nama'] }}</option>
                            @endforeach
                        </select>
                        <select name="unit" class="input !w-44 !py-2 !text-xs" onchange="this.form.submit()">
                            <option value="">Semua Unit</option>
                            @foreach ($units as $u)
                                <option value="{{ $u['id'] }}" @selected($filters['unit'] == $u['id'])>{{ $u['nama'] }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-ghost !px-3 !py-2" title="Cari"><x-icon name="search" class="h-4 w-4" /></button>
                    </form>
                </div>

                <div class="table-wrap">
                    <table class="table-base">
                        <thead>
                            <tr>
                                <th class="w-10">No</th>
                                <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th>Satuan</th>
                                <th>Unit</th>
                                <th class="text-right">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $i => $b)
                                <tr>
                                    <td>{{ ($items->currentPage() - 1) * $items->perPage() + $i + 1 }}</td>
                                    <td class="font-medium">{{ $b->nama }}</td>
                                    <td>{{ $b->spesifikasi }}</td>
                                    <td><span class="badge-blue">{{ $b->satuan?->nama ?? '-' }}</span></td>
                                    <td class="text-xs">{{ $b->unit?->nama ?? '-' }}</td>
                                    <td class="text-right font-semibold">{{ $b->stok }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-deep-space-600/50">Tidak ada data ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
