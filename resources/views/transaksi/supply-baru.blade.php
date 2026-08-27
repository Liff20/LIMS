@extends('layouts.app')

@section('title', 'Supply Baru')
@section('page-title', 'Supply Baru')
@section('page-subtitle', 'Data supply masuk baru')

@section('content')
    @if (session('success'))
        <div class="mb-4 flex items-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-700">
            <x-icon name="check" class="h-5 w-5" />
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 rounded-2xl border border-red-200 bg-red-50/80 px-4 py-3 text-sm font-medium text-red-700">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="card p-6">
            <h3 class="mb-5 flex items-center gap-2 font-bold text-deep-space-600">
                <x-icon name="arrow-right" class="h-5 w-5 text-emerald-500" />
                Form Supply Masuk
            </h3>
            <form method="POST" action="{{ route('transaksi.supply.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="label">Tanggal</label>
                        <input class="input" type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    </div>
                    <div>
                        <label class="label">Supplier</label>
                        <select class="input" name="supplier_id" required>
                            <option value="">Pilih supplier…</option>
                            @foreach ($suppliers as $s)
                                <option value="{{ $s->id }}" @selected(old('supplier_id') == $s->id)>{{ $s->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Barang</label>
                        <select class="input" name="barang_id" required>
                            <option value="">Pilih barang…</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->id }}" @selected(old('barang_id') == $b->id)>{{ $b->nama }} — {{ $b->spesifikasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="label">Qty</label>
                            <input class="input" type="number" name="qty" value="{{ old('qty', 1) }}" min="1" required>
                        </div>
                        <div>
                            <label class="label">Total Harga (Rp)</label>
                            <input class="input" type="number" name="total" value="{{ old('total', 0) }}" min="0">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary w-full">
                        <x-icon name="check" class="h-4 w-4" /> Catat Supply
                    </button>
                </div>
            </form>
        </div>

        <div class="card p-5">
            <h3 class="section-title mb-4">Data Supply Masuk Baru</h3>
            <div class="table-wrap">
                <table class="table-base">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Barang</th>
                            <th class="text-center">Qty</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $s)
                            <tr>
                                <td><span class="badge-blue">{{ $s->kode }}</span></td>
                                <td class="whitespace-nowrap">{{ $s->tanggal->format('Y-m-d') }}</td>
                                <td class="font-medium">{{ $s->supplier?->nama ?? '-' }}</td>
                                <td>{{ $s->barang?->nama ?? '-' }}</td>
                                <td class="text-center font-semibold">{{ $s->qty }}</td>
                                <td class="text-right font-semibold">Rp {{ number_format($s->total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-8 text-center text-deep-space-600/50">Belum ada data supply.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
