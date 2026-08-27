@extends('layouts.app')

@section('title', 'Laporan Barang Keluar')
@section('page-title', 'Laporan Barang Keluar')
@section('page-subtitle', 'Rekap barang keluar (peminjaman)')

@section('content')
    <div class="card p-5">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h3 class="section-title">Barang Keluar</h3>
            <form method="GET" action="{{ route('laporan.keluar') }}" class="flex flex-wrap gap-2">
                <input type="text" name="q" value="{{ $filters['q'] }}" placeholder="Cari barang / peminjam…" class="input !w-48 !py-2 !text-xs">
                <input type="date" name="dari" value="{{ $filters['dari'] }}" class="input !w-40 !py-2 !text-xs">
                <input type="date" name="sampai" value="{{ $filters['sampai'] }}" class="input !w-40 !py-2 !text-xs">
                <button type="submit" class="btn-ghost !px-3 !py-2" title="Cari"><x-icon name="search" class="h-4 w-4" /></button>
            </form>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
                        <th class="w-10">No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Peminjam</th>
                        <th>Unit</th>
                        <th>Barang</th>
                        <th class="text-center">Qty</th>
                        <th>Pemanfaatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><span class="badge-blue">{{ $p->kode }}</span></td>
                            <td class="whitespace-nowrap">{{ $p->tanggal->format('Y-m-d') }}</td>
                            <td class="font-medium">{{ $p->user?->name ?? '-' }}</td>
                            <td class="text-xs">{{ $p->unit?->nama ?? '-' }}</td>
                            <td>{{ $p->barang?->nama ?? '-' }}</td>
                            <td class="text-center font-semibold">{{ $p->qty }}</td>
                            <td><span class="badge-green">{{ $p->pemanfaatan?->nama ?? '-' }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-8 text-center text-deep-space-600/50">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
