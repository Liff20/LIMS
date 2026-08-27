@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page-title', 'Data Peminjaman')
@section('page-subtitle', 'Riwayat pengelolaan pengajuan peminjaman')

@section('content')
    <div class="card p-5">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="section-title">Riwayat Peminjaman</h3>
            <a href="{{ route('transaksi.peminjaman') }}" class="btn-primary">
                <x-icon name="plus" class="h-4 w-4" /> Ajukan Peminjaman
            </a>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Peminjam</th>
                        <th>Unit</th>
                        <th>Barang</th>
                        <th class="text-center">Qty</th>
                        <th>Pemanfaatan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i)
                        <tr>
                            <td><span class="badge-blue">{{ $i['kode'] }}</span></td>
                            <td class="whitespace-nowrap">{{ $i['tanggal'] }}</td>
                            <td class="font-medium">{{ $i['peminjam'] }}</td>
                            <td class="text-xs">{{ $i['unit'] }}</td>
                            <td>{{ $i['barang'] }}</td>
                            <td class="text-center font-semibold">{{ $i['qty'] }}</td>
                            <td><span class="badge-green">{{ $i['pemanfaatan'] }}</span></td>
                            <td class="text-xs">{{ $i['keterangan'] }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-8 text-center text-deep-space-600/50">Belum ada data peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
