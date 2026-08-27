<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\DataProvider;

class BarangController extends Controller
{
    public function berdasarkanUnit()
    {
        $units = DataProvider::units();
        $barang = DataProvider::barang();
        $kartu = DataProvider::kartuStok();

        $data = [];
        foreach ($units as $unit) {
            $items = array_values(array_filter($barang, fn ($b) => $b['unit_id'] === $unit['id']));
            $data[] = [
                'unit' => $unit,
                'items' => $items,
                'kartu' => $kartu[$unit['id']] ?? [],
            ];
        }

        return view('barang.unit', ['data' => $data]);
    }

    public function semua()
    {
        return view('barang.semua');
    }

    public function expire()
    {
        return view('barang.expire');
    }
}
