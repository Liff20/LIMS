@extends('layouts.app')

@section('title', 'Permintaan Baru')
@section('page-title', 'Permintaan Baru')
@section('page-subtitle', 'Data permintaan baru')

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
                <x-icon name="plus" class="h-5 w-5 text-blue-green-400" />
                Form Permintaan Baru
            </h3>
            <form method="POST" action="{{ route('transaksi.permintaan.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="label">Tanggal</label>
                        <input class="input" type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    </div>
                    <div>
                        <label class="label">Pemohon</label>
                        <select class="input" name="user_id" required>
                            <option value="">Pilih pemohon…</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>{{ $u->name }} ({{ $u->role }})</option>
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
                            <label class="label">Status</label>
                            <select class="input" name="status">
                                <option value="Menunggu">Menunggu</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary w-full">
                        <x-icon name="check" class="h-4 w-4" /> Buat Permintaan
                    </button>
                </div>
            </form>
        </div>

        <div class="card p-5">
            <h3 class="section-title mb-4">Data Permintaan Baru</h3>
            <div class="table-wrap">
                <table class="table-base">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Pemohon</th>
                            <th>Barang</th>
                            <th class="text-center">Qty</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $p)
                            <tr>
                                <td><span class="badge-blue">{{ $p->kode }}</span></td>
                                <td class="whitespace-nowrap">{{ $p->tanggal->format('Y-m-d') }}</td>
                                <td class="font-medium">{{ $p->user?->name ?? '-' }}</td>
                                <td>{{ $p->barang?->nama ?? '-' }}</td>
                                <td class="text-center font-semibold">{{ $p->qty }}</td>
                                <td>
                                    <form method="POST" action="{{ route('transaksi.permintaan.status', $p->id) }}" class="flex gap-1">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="input !w-32 !py-1 !text-xs">
                                            @foreach (['Menunggu', 'Disetujui', 'Ditolak'] as $st)
                                                <option value="{{ $st }}" @selected($p->status === $st)>{{ $st }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn-ghost !px-2 !py-1" title="Simpan"><x-icon name="check" class="h-4 w-4" /></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-8 text-center text-deep-space-600/50">Belum ada data permintaan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
