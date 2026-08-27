@extends('layouts.app')

@section('title', 'Alat & Bahan Berdasarkan Unit')
@section('page-title', 'Alat & Bahan Berdasarkan Unit')
@section('page-subtitle', 'Inventaris BHP per kotak unit laboratorium')

@section('content')
    @foreach ($data as $d)
        @php
            $unit = $d['unit'];
            $items = $d['items'];
            $kartu = $d['kartu'];
        @endphp

        <div class="card mb-6 overflow-hidden">
            {{-- Header unit --}}
            <div class="flex flex-col gap-3 border-b border-brand-200 bg-gradient-brand px-6 py-5 text-white sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/20">
                        <x-icon name="flask" class="h-6 w-6" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold leading-tight">{{ $unit['nama'] }}</h3>
                        <p class="text-xs text-white/85">{{ $unit['lokasi'] }} · {{ $unit['penanggung_jawab'] }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="badge bg-white/20 text-white">{{ $unit['kode'] }}</span>
                    <span class="badge bg-white/20 text-white">{{ count($items) }} barang</span>
                </div>
            </div>

            {{-- Kartu stok per semester --}}
            <div class="grid gap-4 p-5 lg:grid-cols-2">
                @foreach ($kartu as $semester)
                    @php
                        $itemsSem = $semester['items'];
                    @endphp
                    <div class="rounded-2xl border border-brand-100 bg-brand-50/40 p-4">
                        <div class="mb-3 flex items-center justify-between">
                            <span class="font-bold text-deep-space-600">Semester {{ $semester['semester'] }} [{{ $semester['tahun'] }}]</span>
                            <span class="badge-blue">Kartu Stok</span>
                        </div>

                        <div class="table-wrap !shadow-none">
                            <table class="table-base">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th class="text-center">Stok Awal</th>
                                        <th class="text-center">Penerimaan</th>
                                        <th class="text-center">Persediaan</th>
                                        <th class="text-center">Pemakaian</th>
                                        <th class="text-center">Sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($itemsSem as $barangId => $s)
                                        @php
                                            $namaBarang = collect($items)->firstWhere('id', $barangId)['nama'] ?? 'Barang #' . $barangId;
                                        @endphp
                                        <tr>
                                            <td class="text-xs font-medium">{{ $namaBarang }}</td>
                                            <td class="text-center">{{ $s['stok_awal'] }}</td>
                                            <td class="text-center text-emerald-600">{{ $s['penerimaan'] }}</td>
                                            <td class="text-center font-semibold">{{ $s['persediaan'] }}</td>
                                            <td class="text-center text-orange-princeton">{{ $s['pemakaian'] }}</td>
                                            <td class="text-center font-bold text-blue-green-600">{{ $s['sisa'] }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="py-4 text-center text-xs text-deep-space-600/50">Belum ada data stok.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection
