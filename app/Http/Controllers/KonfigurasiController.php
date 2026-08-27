<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\DataProvider;

class KonfigurasiController extends Controller
{
    public function unit()
    {
        return view('konfigurasi.unit', ['items' => DataProvider::units()]);
    }

    public function satuan()
    {
        return view('konfigurasi.satuan', ['items' => DataProvider::satuan()]);
    }

    public function jenisBarang()
    {
        return view('konfigurasi.jenis-barang', ['items' => DataProvider::jenisBarang()]);
    }

    public function jenisPengguna()
    {
        return view('konfigurasi.jenis-pengguna', ['items' => DataProvider::jenisPengguna()]);
    }

    public function pengguna()
    {
        $items = DataProvider::users();
        $q = request('q');
        if ($q) {
            $items = array_values(array_filter($items, fn ($u) =>
                stripos($u['nama'], $q) !== false ||
                stripos($u['username'], $q) !== false ||
                stripos($u['role'], $q) !== false
            ));
        }

        return view('konfigurasi.pengguna', [
            'items' => $items,
            'units' => DataProvider::units(),
            'q' => $q,
        ]);
    }

    public function supplier()
    {
        return view('konfigurasi.supplier');
    }
}
