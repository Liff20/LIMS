@extends('layouts.app')

@section('title', 'Detail Alat Bahan Keluar')
@section('page-title', 'Detail Alat Bahan Keluar')
@section('page-subtitle', 'Laporan pemakaian / barang keluar')

@section('content')
    <div class="card p-5">
        <div class="mb-4 flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
            <h3 class="section-title">Laporan Alat & Bahan Keluar</h3>
            <form method="GET" action="{{ route('laporan.keluar') }}" class="flex flex-wrap gap-2">
                <input type="text" name="q" value="{{ $filters['q'] }}" placeholder="Cari barang / peminjam…" class="input !w-48 !py-2 !text-xs">
                <input type="date" name="dari" value="{{ $filters['dari'] }}" class="input !w-40 !py-2 !text-xs" title="Dari tanggal">
                <input type="date" name="sampai" value="{{ $filters['sampai'] }}" class="input !w-40 !py-2 !text-xs" title="Sampai tanggal">
                <button type="submit" class="btn-ghost !px-3 !py-2" title="Filter"><x-icon name="filter" class="h-4 w-4" /></button>
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
                    @forelse ($items as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><span class="badge-blue">{{ $row['kode'] }}</span></td>
                            <td class="whitespace-nowrap">{{ $row['tanggal'] }}</td>
                            <td class="font-medium">{{ $row['peminjam'] }}</td>
                            <td class="text-xs">{{ $row['unit'] }}</td>
                            <td>{{ $row['barang'] }}</td>
                            <td class="text-center font-semibold">{{ $row['qty'] }}</td>
                            <td><span class="badge-green">{{ $row['pemanfaatan'] }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-8 text-center text-deep-space-600/50">Tidak ada data ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
