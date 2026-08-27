@extends('layouts.app')

@section('title', 'Data Satuan')
@section('page-title', 'Data Satuan')
@section('page-subtitle', 'Satuan barang')

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
        <div class="mb-4 flex items-center justify-between">
            <h3 class="section-title">Daftar Satuan Barang</h3>
            <button class="btn-primary" type="button" x-data x-on:click="$dispatch('open-modal', 'modal-satuan')">
                <x-icon name="plus" class="h-4 w-4" /> Tambah Satuan
            </button>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
                        <th class="w-10">No</th>
                        <th>Nama Satuan</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i => $s)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="font-medium">{{ $s->nama }}</td>
                            <td class="text-right">
                                <div class="inline-flex gap-1">
                                    <button class="btn-ghost !px-2.5 !py-1.5" title="Edit"
                                        x-data x-on:click="$dispatch('open-modal', 'modal-satuan-{{ $s->id }}')">
                                        <x-icon name="edit" class="h-4 w-4" />
                                    </button>
                                    <form method="POST" action="{{ route('konfigurasi.satuan.destroy', $s->id) }}"
                                        onsubmit="return confirm('Hapus satuan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger !px-2.5 !py-1.5" title="Hapus"><x-icon name="trash" class="h-4 w-4" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-8 text-center text-deep-space-600/50">Belum ada data satuan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="modal-satuan" title="Tambah Satuan">
        <form method="POST" action="{{ route('konfigurasi.satuan.store') }}">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="label">Nama Satuan</label>
                    <input class="input" name="nama" value="{{ old('nama') }}" placeholder="Botol / Box / Kg…" required>
                </div>
                <button type="submit" class="btn-primary w-full">Simpan</button>
            </div>
        </form>
    </x-modal>

    @foreach ($items as $s)
        <x-modal id="modal-satuan-{{ $s->id }}" title="Edit Satuan">
            <form method="POST" action="{{ route('konfigurasi.satuan.update', $s->id) }}">
                @csrf
                @method('PUT')
                <div class="space-y-3">
                    <div>
                        <label class="label">Nama Satuan</label>
                        <input class="input" name="nama" value="{{ $s->nama }}" required>
                    </div>
                    <button type="submit" class="btn-primary w-full">Simpan Perubahan</button>
                </div>
            </form>
        </x-modal>
    @endforeach
@endsection
