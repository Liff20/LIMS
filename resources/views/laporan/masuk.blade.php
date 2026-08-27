@extends('layouts.app')

@section('title', 'Laporan Barang Masuk')
@section('page-title', 'Laporan Barang Masuk')
@section('page-subtitle', 'Rekap barang masuk (supply)')

@section('content')
    <div class="card p-5">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h3 class="section-title">Barang Masuk</h3>
            <form method="GET" action="{{ route('laporan.masuk') }}" class="flex flex-wrap gap-2">
                <input type="text" name="q" value="{{ $filters['q'] }}" placeholder="Cari barang / supplier…" class="input !w-48 !py-2 !text-xs">
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
                        <th>Supplier</th>
                        <th>Unit</th>
                        <th>Barang</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i => $s)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><span class="badge-blue">{{ $s->kode }}</span></td>
                            <td class="whitespace-nowrap">{{ $s->tanggal->format('Y-m-d') }}</td>
                            <td class="font-medium">{{ $s->supplier?->nama ?? '-' }}</td>
                            <td class="text-xs">{{ $s->unit?->nama ?? '-' }}</td>
                            <td>{{ $s->barang?->nama ?? '-' }}</td>
                            <td class="text-center font-semibold">{{ $s->qty }}</td>
                            <td class="text-right font-semibold">Rp {{ number_format($s->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-8 text-center text-deep-space-600/50">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
