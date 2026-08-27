@extends('layouts.app')

@section('title', 'Expire Date')
@section('page-title', 'Expire Date')
@section('page-subtitle', 'Pantau tanggal kedaluwarsa bahan')

@section('content')
    <div class="card p-5">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="section-title">Daftar Barang Berdasarkan Kedaluwarsa</h3>
            <span class="badge-amber">Total: {{ count($items) }} barang</span>
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
                        <th class="text-center">Stok</th>
                        <th>Tanggal Expired</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i => $b)
                        @php
                            $hari = $b['hari_sisa'];
                            $level = $hari < 0 ? 'Expired' : ($hari <= 30 ? 'Kritis' : ($hari <= 90 ? 'Waspada' : 'Aman'));
                            $badge = $level === 'Expired' ? 'badge-red' : ($level === 'Kritis' ? 'badge-red' : ($level === 'Waspada' ? 'badge-amber' : 'badge-green'));
                        @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="font-medium">{{ $b['nama'] }}</td>
                            <td class="text-xs">{{ $b['spesifikasi'] }}</td>
                            <td><span class="badge-blue">{{ $b['satuan'] }}</span></td>
                            <td class="text-xs">{{ $b['unit'] }}</td>
                            <td class="text-center font-semibold">{{ $b['stok'] }}</td>
                            <td class="whitespace-nowrap">{{ $b['expired'] }}</td>
                            <td><span class="{{ $badge }}">{{ $level }} ({{ $hari }} hari)</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-8 text-center text-deep-space-600/50">Tidak ada data barang dengan tanggal kedaluwarsa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
