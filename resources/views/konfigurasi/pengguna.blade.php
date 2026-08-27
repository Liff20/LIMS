@extends('layouts.app')

@section('title', 'Data Pengguna')
@section('page-title', 'Data Pengguna')
@section('page-subtitle', 'Kelola pengguna / user sistem')

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
            <h3 class="section-title">Daftar Pengguna</h3>
            <div class="flex gap-2">
                <form method="GET" action="{{ route('konfigurasi.pengguna') }}" class="flex gap-2">
                    <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama / role…" class="input !w-52 !py-2 !text-xs">
                    <button type="submit" class="btn-ghost !px-3 !py-2" title="Cari"><x-icon name="search" class="h-4 w-4" /></button>
                </form>
                <button class="btn-primary" type="button" x-data x-on:click="$dispatch('open-modal', 'modal-pengguna')">
                    <x-icon name="plus" class="h-4 w-4" /> Tambah
                </button>
            </div>
        </div>

        <div class="table-wrap">
            <table class="table-base">
                <thead>
                    <tr>
                        <th class="w-10">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $i => $u)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="font-medium">{{ $u->name }}</td>
                            <td>{{ $u->username }}</td>
                            <td class="text-xs">{{ $u->email }}</td>
                            <td><span class="badge-blue">{{ $u->role }}</span></td>
                            <td class="text-xs">{{ $u->unit?->nama ?? '—' }}</td>
                            <td><span class="{{ $u->status === 'Aktif' ? 'badge-green' : 'badge-red' }}">{{ $u->status }}</span></td>
                            <td class="text-right">
                                <div class="inline-flex gap-1">
                                    <button class="btn-ghost !px-2.5 !py-1.5" title="Edit"
                                        x-data x-on:click="$dispatch('open-modal', 'modal-pengguna-{{ $u->id }}')">
                                        <x-icon name="edit" class="h-4 w-4" />
                                    </button>
                                    <form method="POST" action="{{ route('konfigurasi.pengguna.destroy', $u->id) }}"
                                        onsubmit="return confirm('Hapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger !px-2.5 !py-1.5" title="Hapus"><x-icon name="trash" class="h-4 w-4" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-8 text-center text-deep-space-600/50">Tidak ada data ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="modal-pengguna" title="Tambah Pengguna">
        <form method="POST" action="{{ route('konfigurasi.pengguna.store') }}">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="label">Nama Lengkap</label>
                    <input class="input" name="nama" value="{{ old('nama') }}" required>
                </div>
                <div>
                    <label class="label">Username</label>
                    <input class="input" name="username" value="{{ old('username') }}" required>
                </div>
                <div>
                    <label class="label">Email</label>
                    <input class="input" type="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div>
                    <label class="label">Role</label>
                    <select class="input" name="role" required>
                        @foreach (['Super Admin', 'Admin', 'Admin Lab', 'Dosen', 'Peneliti', 'Mahasiswa'] as $r)
                            <option value="{{ $r }}" @selected(old('role') === $r)>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label">Unit</label>
                    <select class="input" name="unit_id">
                        <option value="">— Tanpa Unit —</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" @selected(old('unit_id') == $unit->id)>{{ $unit->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label">Status</label>
                    <select class="input" name="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
                <div>
                    <label class="label">Password</label>
                    <input class="input" type="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary w-full">Simpan</button>
            </div>
        </form>
    </x-modal>

    @foreach ($items as $u)
        <x-modal id="modal-pengguna-{{ $u->id }}" title="Edit Pengguna">
            <form method="POST" action="{{ route('konfigurasi.pengguna.update', $u->id) }}">
                @csrf
                @method('PUT')
                <div class="space-y-3">
                    <div>
                        <label class="label">Nama Lengkap</label>
                        <input class="input" name="nama" value="{{ $u->name }}" required>
                    </div>
                    <div>
                        <label class="label">Username</label>
                        <input class="input" name="username" value="{{ $u->username }}" required>
                    </div>
                    <div>
                        <label class="label">Email</label>
                        <input class="input" type="email" name="email" value="{{ $u->email }}" required>
                    </div>
                    <div>
                        <label class="label">Role</label>
                        <select class="input" name="role" required>
                            @foreach (['Super Admin', 'Admin', 'Admin Lab', 'Dosen', 'Peneliti', 'Mahasiswa'] as $r)
                                <option value="{{ $r }}" @selected($u->role === $r)>{{ $r }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Unit</label>
                        <select class="input" name="unit_id">
                            <option value="">— Tanpa Unit —</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" @selected($u->unit_id == $unit->id)>{{ $unit->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Status</label>
                        <select class="input" name="status">
                            <option value="Aktif" @selected($u->status === 'Aktif')>Aktif</option>
                            <option value="Nonaktif" @selected($u->status === 'Nonaktif')>Nonaktif</option>
                        </select>
                    </div>
                    <div>
                        <label class="label">Password Baru (kosongkan jika tidak diubah)</label>
                        <input class="input" type="password" name="password">
                    </div>
                    <button type="submit" class="btn-primary w-full">Simpan Perubahan</button>
                </div>
            </form>
        </x-modal>
    @endforeach
@endsection
