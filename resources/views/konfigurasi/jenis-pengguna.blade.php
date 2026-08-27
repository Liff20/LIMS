@extends('layouts.app')

@section('title', 'Data Jenis Pengguna')
@section('page-title', 'Data Jenis Pengguna')
@section('page-subtitle', 'Klasifikasi tujuan pemanfaatan barang')

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
            <h3 class="section-title">Daftar Jenis Penggunaan Barang</h3>
            <button class="btn-primary" type="button" x-data x-on:click="$dispatch('open-modal', 'modal-jenis-pengguna')">
                <x-icon name="plus" class="h-4 w-4" /> Tambah Jenis
            </button>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
                        <th class="w-10">No</th>
                        <th>Jenis Penggunaan</th>
                        <th>Deskripsi</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i => $j)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="font-medium">{{ $j->nama }}</td>
                            <td>{{ $j->deskripsi }}</td>
                            <td class="text-right">
                                <div class="inline-flex gap-1">
                                    <button class="btn-ghost !px-2.5 !py-1.5" title="Edit"
                                        x-data x-on:click="$dispatch('open-modal', 'modal-jenis-pengguna-{{ $j->id }}')">
                                        <x-icon name="edit" class="h-4 w-4" />
                                    </button>
                                    <form method="POST" action="{{ route('konfigurasi.jenis-pengguna.destroy', $j->id) }}"
                                        onsubmit="return confirm('Hapus jenis ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger !px-2.5 !py-1.5" title="Hapus"><x-icon name="trash" class="h-4 w-4" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-8 text-center text-deep-space-600/50">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="modal-jenis-pengguna" title="Tambah Jenis Penggunaan">
        <form method="POST" action="{{ route('konfigurasi.jenis-pengguna.store') }}">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="label">Nama Jenis</label>
                    <input class="input" name="nama" value="{{ old('nama') }}" required>
                </div>
                <div>
                    <label class="label">Deskripsi</label>
                    <textarea class="input" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                </div>
                <button type="submit" class="btn-primary w-full">Simpan</button>
            </div>
        </form>
    </x-modal>

    @foreach ($items as $j)
        <x-modal id="modal-jenis-pengguna-{{ $j->id }}" title="Edit Jenis Penggunaan">
            <form method="POST" action="{{ route('konfigurasi.jenis-pengguna.update', $j->id) }}">
                @csrf
                @method('PUT')
                <div class="space-y-3">
                    <div>
                        <label class="label">Nama Jenis</label>
                        <input class="input" name="nama" value="{{ $j->nama }}" required>
                    </div>
                    <div>
                        <label class="label">Deskripsi</label>
                        <textarea class="input" name="deskripsi" rows="3">{{ $j->deskripsi }}</textarea>
                    </div>
                    <button type="submit" class="btn-primary w-full">Simpan Perubahan</button>
                </div>
            </form>
        </x-modal>
    @endforeach
@endsection
