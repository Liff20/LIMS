@extends('layouts.app')

@section('title', 'Data Satuan')
@section('page-title', 'Data Satuan')
@section('page-subtitle', 'Satuan barang')

@section('content')
    <div class="card p-5">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="section-title">Daftar Satuan Barang</h3>
            <button class="btn-primary" type="button">
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
                    @foreach ($items as $i => $s)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="font-medium">{{ $s['nama'] }}</td>
                            <td class="text-right">
                                <div class="inline-flex gap-1">
                                    <button class="btn-ghost !px-2.5 !py-1.5" title="Edit"><x-icon name="edit" class="h-4 w-4" /></button>
                                    <button class="btn-danger !px-2.5 !py-1.5" title="Hapus"><x-icon name="trash" class="h-4 w-4" /></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
