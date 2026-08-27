@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page-title', 'Data Peminjaman')
@section('page-subtitle', 'Riwayat pengelolaan pengajuan peminjaman')

@section('content')
    @if (session('success'))
        <div class="mb-4 flex items-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-700">
            <x-icon name="check" class="h-5 w-5" />
            {{ session('success') }}
        </div>
    @endif

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
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $p)
                        <tr>
                            <td><span class="badge-blue">{{ $p->kode }}</span></td>
                            <td class="whitespace-nowrap">{{ $p->tanggal->format('Y-m-d') }}</td>
                            <td class="font-medium">{{ $p->user?->name ?? '-' }}</td>
                            <td class="text-xs">{{ $p->unit?->nama ?? '-' }}</td>
                            <td>{{ $p->barang?->nama ?? '-' }}</td>
                            <td class="text-center font-semibold">{{ $p->qty }}</td>
                            <td><span class="badge-green">{{ $p->pemanfaatan?->nama ?? '-' }}</span></td>
                            <td class="text-xs">{{ $p->keterangan ?? '-' }}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('transaksi.peminjaman.destroy', $p->id) }}"
                                    onsubmit="return confirm('Hapus data peminjaman ini? Stok akan dikembalikan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-danger !px-2.5 !py-1.5" title="Hapus"><x-icon name="trash" class="h-4 w-4" /></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="py-8 text-center text-deep-space-600/50">Belum ada data peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
