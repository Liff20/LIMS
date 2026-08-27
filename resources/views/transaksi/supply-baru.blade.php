@extends('layouts.app')

@section('title', 'Supply Baru')
@section('page-title', 'Supply Baru')
@section('page-subtitle', 'Data supply masuk baru')

@section('content')
    <div class="card p-5">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="section-title">Data Supply Masuk Baru</h3>
            <button class="btn-primary" type="button"><x-icon name="plus" class="h-4 w-4" /> Tambah Supply</button>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
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
                    @forelse ($items as $i)
                        <tr>
                            <td><span class="badge-blue">{{ $i['kode'] }}</span></td>
                            <td class="whitespace-nowrap">{{ $i['tanggal'] }}</td>
                            <td class="font-medium">{{ $i['supplier'] }}</td>
                            <td class="text-xs">{{ $i['unit'] }}</td>
                            <td>{{ $i['barang'] }}</td>
                            <td class="text-center font-semibold">{{ $i['qty'] }}</td>
                            <td class="text-right font-semibold">Rp {{ number_format($i['total'], 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-8 text-center text-deep-space-600/50">Belum ada data supply.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
