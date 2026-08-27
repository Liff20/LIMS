@extends('layouts.app')

@section('title', 'Data Pengguna')
@section('page-title', 'Data Pengguna')
@section('page-subtitle', 'Kelola pengguna / user sistem')

@section('content')
    <div class="card p-5">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h3 class="section-title">Daftar Pengguna</h3>
            <div class="flex gap-2">
                <form method="GET" action="{{ route('konfigurasi.pengguna') }}" class="flex gap-2">
                    <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama / role…" class="input !w-52 !py-2 !text-xs">
                    <button type="submit" class="btn-ghost !px-3 !py-2" title="Cari"><x-icon name="search" class="h-4 w-4" /></button>
                </form>
                <button class="btn-primary" type="button">
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
                            <td class="font-medium">{{ $u['nama'] }}</td>
                            <td>{{ $u['username'] }}</td>
                            <td class="text-xs">{{ $u['email'] }}</td>
                            <td><span class="badge-blue">{{ $u['role'] }}</span></td>
                            <td class="text-xs">{{ $u['unit_id'] ? \App\Support\DataProvider::unitName($u['unit_id']) : '—' }}</td>
                            <td><span class="{{ $u['status'] === 'Aktif' ? 'badge-green' : 'badge-red' }}">{{ $u['status'] }}</span></td>
                            <td class="text-right">
                                <div class="inline-flex gap-1">
                                    <button class="btn-ghost !px-2.5 !py-1.5" title="Edit"><x-icon name="edit" class="h-4 w-4" /></button>
                                    <button class="btn-danger !px-2.5 !py-1.5" title="Hapus"><x-icon name="trash" class="h-4 w-4" /></button>
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
@endsection
