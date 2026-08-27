@extends('layouts.app')

@section('title', 'Semua Alat & Bahan')
@section('page-title', 'Semua Alat & Bahan')
@section('page-subtitle', 'Daftar seluruh alat & bahan')

@section('content')
    @if ($errors->any())
        <div class="mb-4 rounded-2xl border border-red-200 bg-red-50/80 px-4 py-3 text-sm font-medium text-red-700">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-5">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h3 class="section-title">Daftar Alat & Bahan</h3>
            <div class="flex flex-wrap gap-2">
                <form method="GET" action="{{ route('barang.semua') }}" class="flex flex-wrap gap-2">
                    <input type="text" name="q" value="{{ $filters['q'] }}" placeholder="Cari barang…" class="input !w-44 !py-2 !text-xs">
                    <select name="jenis" class="input !w-44 !py-2 !text-xs" onchange="this.form.submit()">
                        <option value="">Semua Jenis</option>
                        @foreach ($jenis as $j)
                            <option value="{{ $j->nama }}" @selected($filters['jenis'] === $j->nama)>{{ $j->nama }}</option>
                        @endforeach
                    </select>
                    <select name="unit" class="input !w-44 !py-2 !text-xs" onchange="this.form.submit()">
                        <option value="">Semua Unit</option>
                        @foreach ($units as $u)
                            <option value="{{ $u->id }}" @selected($filters['unit'] == $u->id)>{{ $u->nama }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-ghost !px-3 !py-2" title="Cari"><x-icon name="search" class="h-4 w-4" /></button>
                </form>
                <button class="btn-primary" type="button" x-data x-on:click="$dispatch('open-modal', 'modal-barang')">
                    <x-icon name="plus" class="h-4 w-4" /> Tambah
                </button>
            </div>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
                        <th class="w-10">No</th>
                        <th>Nama Barang</th>
                        <th>Spesifikasi</th>
                        <th>Satuan</th>
                        <th>Jenis</th>
                        <th>Unit</th>
                        <th>Expired</th>
                        <th class="text-right">Stok</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i => $b)
                        <tr>
                            <td>{{ ($items->currentPage() - 1) * $items->perPage() + $i + 1 }}</td>
                            <td class="font-medium">{{ $b->nama }}</td>
                            <td class="text-xs">{{ $b->spesifikasi }}</td>
                            <td><span class="badge-blue">{{ $b->satuan?->nama ?? '-' }}</span></td>
                            <td class="text-xs">{{ $b->jenis?->nama ?? '-' }}</td>
                            <td class="text-xs">{{ $b->unit?->nama ?? '-' }}</td>
                            <td class="whitespace-nowrap text-xs">{{ $b->expired?->format('Y-m-d') ?? '—' }}</td>
                            <td class="text-right font-semibold">{{ $b->stok }}</td>
                            <td class="text-right">
                                <div class="inline-flex gap-1">
                                    <button class="btn-ghost !px-2.5 !py-1.5" title="Edit"
                                        x-data x-on:click="$dispatch('open-modal', 'modal-barang-{{ $b->id }}')">
                                        <x-icon name="edit" class="h-4 w-4" />
                                    </button>
                                    <form method="POST" action="{{ route('barang.destroy', $b->id) }}"
                                        onsubmit="return confirm('Hapus barang ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger !px-2.5 !py-1.5" title="Hapus"><x-icon name="trash" class="h-4 w-4" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="py-8 text-center text-deep-space-600/50">Tidak ada data ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $items->links() }}
        </div>
    </div>

    {{-- Modal tambah --}}
    <x-modal id="modal-barang" title="Tambah Barang">
        <form method="POST" action="{{ route('barang.store') }}">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="label">Nama Barang</label>
                    <input class="input" name="nama" value="{{ old('nama') }}" required>
                </div>
                <div>
                    <label class="label">Spesifikasi</label>
                    <input class="input" name="spesifikasi" value="{{ old('spesifikasi') }}">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="label">Satuan</label>
                        <select class="input" name="satuan_id" required>
                            <option value="">Pilih…</option>
                            @foreach (\App\Models\Satuan::orderBy('nama')->get() as $s)
                                <option value="{{ $s->id }}" @selected(old('satuan_id') == $s->id)>{{ $s->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Jenis</label>
                        <select class="input" name="jenis_id" required>
                            <option value="">Pilih…</option>
                            @foreach ($jenis as $j)
                                <option value="{{ $j->id }}" @selected(old('jenis_id') == $j->id)>{{ $j->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="label">Unit</label>
                        <select class="input" name="unit_id" required>
                            <option value="">Pilih…</option>
                            @foreach ($units as $u)
                                <option value="{{ $u->id }}" @selected(old('unit_id') == $u->id)>{{ $u->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Stok</label>
                        <input class="input" type="number" name="stok" value="{{ old('stok', 0) }}" min="0" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="label">Tanggal Expired</label>
                        <input class="input" type="date" name="expired" value="{{ old('expired') }}">
                    </div>
                    <div>
                        <label class="label">Harga</label>
                        <input class="input" type="number" name="harga" value="{{ old('harga', 0) }}" min="0">
                    </div>
                </div>
                <button type="submit" class="btn-primary w-full">Simpan</button>
            </div>
        </form>
    </x-modal>

    {{-- Modal edit --}}
    @foreach ($items as $b)
        <x-modal id="modal-barang-{{ $b->id }}" title="Edit Barang">
            <form method="POST" action="{{ route('barang.update', $b->id) }}">
                @csrf
                @method('PUT')
                <div class="space-y-3">
                    <div>
                        <label class="label">Nama Barang</label>
                        <input class="input" name="nama" value="{{ $b->nama }}" required>
                    </div>
                    <div>
                        <label class="label">Spesifikasi</label>
                        <input class="input" name="spesifikasi" value="{{ $b->spesifikasi }}">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="label">Satuan</label>
                            <select class="input" name="satuan_id" required>
                                @foreach (\App\Models\Satuan::orderBy('nama')->get() as $s)
                                    <option value="{{ $s->id }}" @selected($b->satuan_id == $s->id)>{{ $s->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="label">Jenis</label>
                            <select class="input" name="jenis_id" required>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id }}" @selected($b->jenis_id == $j->id)>{{ $j->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="label">Unit</label>
                            <select class="input" name="unit_id" required>
                                @foreach ($units as $u)
                                    <option value="{{ $u->id }}" @selected($b->unit_id == $u->id)>{{ $u->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="label">Stok</label>
                            <input class="input" type="number" name="stok" value="{{ $b->stok }}" min="0" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="label">Tanggal Expired</label>
                            <input class="input" type="date" name="expired" value="{{ $b->expired?->format('Y-m-d') }}">
                        </div>
                        <div>
                            <label class="label">Harga</label>
                            <input class="input" type="number" name="harga" value="{{ $b->harga }}" min="0">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary w-full">Simpan Perubahan</button>
                </div>
            </form>
        </x-modal>
    @endforeach
@endsection
