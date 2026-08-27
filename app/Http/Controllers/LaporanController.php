<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\DataProvider;

class LaporanController extends Controller
{
    public function keluar(Request $request)
    {
        $items = DataProvider::peminjaman();
        $q = $request->query('q');
        $dari = $request->query('dari');
        $sampai = $request->query('sampai');

        if ($q) {
            $items = array_values(array_filter($items, fn ($i) =>
                stripos($i['barang'], $q) !== false || stripos($i['peminjam'], $q) !== false
            ));
        }
        if ($dari) {
            $items = array_values(array_filter($items, fn ($i) => $i['tanggal'] >= $dari));
        }
        if ($sampai) {
            $items = array_values(array_filter($items, fn ($i) => $i['tanggal'] <= $sampai));
        }

        return view('laporan.keluar', [
            'items' => $items,
            'units' => DataProvider::units(),
            'filters' => ['q' => $q, 'dari' => $dari, 'sampai' => $sampai],
        ]);
    }

    public function masuk(Request $request)
    {
        $items = DataProvider::supply();
        $q = $request->query('q');
        $dari = $request->query('dari');
        $sampai = $request->query('sampai');

        if ($q) {
            $items = array_values(array_filter($items, fn ($i) =>
                stripos($i['barang'], $q) !== false || stripos($i['supplier'], $q) !== false
            ));
        }
        if ($dari) {
            $items = array_values(array_filter($items, fn ($i) => $i['tanggal'] >= $dari));
        }
        if ($sampai) {
            $items = array_values(array_filter($items, fn ($i) => $i['tanggal'] <= $sampai));
        }

        return view('laporan.masuk', [
            'items' => $items,
            'units' => DataProvider::units(),
            'filters' => ['q' => $q, 'dari' => $dari, 'sampai' => $sampai],
        ]);
    }
}
