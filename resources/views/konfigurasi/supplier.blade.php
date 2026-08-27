@extends('layouts.app')

@section('title', 'Data Supplier')
@section('page-title', 'Data Supplier')
@section('page-subtitle', 'Kelola data pemasok')

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
            <h3 class="section-title">Daftar Supplier</h3>
            <button class="btn-primary" type="button" x-data x-on:click="$dispatch('open-modal', 'modal-supplier')">
                <x-icon name="plus" class="h-4 w-4" /> Tambah Supplier
            </button>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
                        <th class="w-10">No</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i => $s)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="font-medium">{{ $s->nama }}</td>
                            <td>{{ $s->alamat }}</td>
                            <td>{{ $s->telepon }}</td>
                            <td class="text-right">
                                <div class="inline-flex gap-1">
                                    <button class="btn-ghost !px-2.5 !py-1.5" title="Edit"
                                        x-data x-on:click="$dispatch('open-modal', 'modal-supplier-{{ $s->id }}')">
                                        <x-icon name="edit" class="h-4 w-4" />
                                    </button>
                                    <form method="POST" action="{{ route('konfigurasi.supplier.destroy', $s->id) }}"
                                        onsubmit="return confirm('Hapus supplier ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger !px-2.5 !py-1.5" title="Hapus"><x-icon name="trash" class="h-4 w-4" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-8 text-center text-deep-space-600/50">Belum ada data supplier.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="modal-supplier" title="Tambah Supplier">
        <form method="POST" action="{{ route('konfigurasi.supplier.store') }}">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="label">Nama Supplier</label>
                    <input class="input" name="nama" value="{{ old('nama') }}" required>
                </div>
                <div>
                    <label class="label">Alamat</label>
                    <input class="input" name="alamat" value="{{ old('alamat') }}">
                </div>
                <div>
                    <label class="label">Telepon</label>
                    <input class="input" name="telepon" value="{{ old('telepon') }}">
                </div>
                <button type="submit" class="btn-primary w-full">Simpan</button>
            </div>
        </form>
    </x-modal>

    @foreach ($items as $s)
        <x-modal id="modal-supplier-{{ $s->id }}" title="Edit Supplier">
            <form method="POST" action="{{ route('konfigurasi.supplier.update', $s->id) }}">
                @csrf
                @method('PUT')
                <div class="space-y-3">
                    <div>
                        <label class="label">Nama Supplier</label>
                        <input class="input" name="nama" value="{{ $s->nama }}" required>
                    </div>
                    <div>
                        <label class="label">Alamat</label>
                        <input class="input" name="alamat" value="{{ $s->alamat }}">
                    </div>
                    <div>
                        <label class="label">Telepon</label>
                        <input class="input" name="telepon" value="{{ $s->telepon }}">
                    </div>
                    <button type="submit" class="btn-primary w-full">Simpan Perubahan</button>
                </div>
            </form>
        </x-modal>
    @endforeach
@endsection
