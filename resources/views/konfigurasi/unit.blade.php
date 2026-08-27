@extends('layouts.app')

@section('title', 'Data Unit')
@section('page-title', 'Data Unit')
@section('page-subtitle', 'Unit kerja / nama laboratorium')

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
            <h3 class="section-title">Daftar Unit Kerja</h3>
            <button class="btn-primary" type="button" x-data x-on:click="$dispatch('open-modal', 'modal-unit')">
                <x-icon name="plus" class="h-4 w-4" /> Tambah Unit
            </button>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
                        <th class="w-10">No</th>
                        <th>Kode</th>
                        <th>Nama Unit / Lab</th>
                        <th>Lokasi</th>
                        <th>Penanggung Jawab</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i => $u)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><span class="badge-blue">{{ $u->kode }}</span></td>
                            <td class="font-medium">{{ $u->nama }}</td>
                            <td>{{ $u->lokasi }}</td>
                            <td>{{ $u->penanggung_jawab }}</td>
                            <td class="text-right">
                                <div class="inline-flex gap-1">
                                    <button class="btn-ghost !px-2.5 !py-1.5" title="Edit"
                                        x-data x-on:click="$dispatch('open-modal', 'modal-unit-{{ $u->id }}')">
                                        <x-icon name="edit" class="h-4 w-4" />
                                    </button>
                                    <form method="POST" action="{{ route('konfigurasi.unit.destroy', $u->id) }}"
                                        onsubmit="return confirm('Hapus unit ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger !px-2.5 !py-1.5" title="Hapus"><x-icon name="trash" class="h-4 w-4" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 text-center text-deep-space-600/50">Belum ada data unit.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="modal-unit" title="Tambah Unit">
        <form method="POST" action="{{ route('konfigurasi.unit.store') }}">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="label">Kode</label>
                    <input class="input" name="kode" value="{{ old('kode') }}" placeholder="LAB-XXX" required>
                </div>
                <div>
                    <label class="label">Nama Unit / Lab</label>
                    <input class="input" name="nama" value="{{ old('nama') }}" required>
                </div>
                <div>
                    <label class="label">Lokasi</label>
                    <input class="input" name="lokasi" value="{{ old('lokasi') }}">
                </div>
                <div>
                    <label class="label">Penanggung Jawab</label>
                    <input class="input" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}">
                </div>
                <button type="submit" class="btn-primary w-full">Simpan</button>
            </div>
        </form>
    </x-modal>

    @foreach ($items as $u)
        <x-modal id="modal-unit-{{ $u->id }}" title="Edit Unit">
            <form method="POST" action="{{ route('konfigurasi.unit.update', $u->id) }}">
                @csrf
                @method('PUT')
                <div class="space-y-3">
                    <div>
                        <label class="label">Kode</label>
                        <input class="input" name="kode" value="{{ $u->kode }}" required>
                    </div>
                    <div>
                        <label class="label">Nama Unit / Lab</label>
                        <input class="input" name="nama" value="{{ $u->nama }}" required>
                    </div>
                    <div>
                        <label class="label">Lokasi</label>
                        <input class="input" name="lokasi" value="{{ $u->lokasi }}">
                    </div>
                    <div>
                        <label class="label">Penanggung Jawab</label>
                        <input class="input" name="penanggung_jawab" value="{{ $u->penanggung_jawab }}">
                    </div>
                    <button type="submit" class="btn-primary w-full">Simpan Perubahan</button>
                </div>
            </form>
        </x-modal>
    @endforeach
@endsection
