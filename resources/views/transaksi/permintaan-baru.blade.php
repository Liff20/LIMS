@extends('layouts.app')

@section('title', 'Permintaan Baru')
@section('page-title', 'Permintaan Baru')
@section('page-subtitle', 'Data permintaan baru')

@section('content')
    <div class="card p-5">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="section-title">Data Permintaan Baru</h3>
            <button class="btn-primary" type="button"><x-icon name="plus" class="h-4 w-4" /> Buat Permintaan</button>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Pemohon</th>
                        <th>Unit</th>
                        <th>Barang</th>
                        <th class="text-center">Qty</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i)
                        <tr>
                            <td><span class="badge-blue">{{ $i['kode'] }}</span></td>
                            <td class="whitespace-nowrap">{{ $i['tanggal'] }}</td>
                            <td class="font-medium">{{ $i['pemohon'] }}</td>
                            <td class="text-xs">{{ $i['unit'] }}</td>
                            <td>{{ $i['barang'] }}</td>
                            <td class="text-center font-semibold">{{ $i['qty'] }}</td>
                            <td>
                                <span class="{{ $i['status'] === 'Disetujui' ? 'badge-green' : 'badge-amber' }}">{{ $i['status'] }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-8 text-center text-deep-space-600/50">Belum ada data permintaan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
