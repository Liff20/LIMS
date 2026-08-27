<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\DataProvider;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jenis = DataProvider::jenisBarang();
        $barang = DataProvider::barang();

        // Filter
        $q = $request->query('q');
        $jenisFilter = $request->query('jenis');
        $unitFilter = $request->query('unit');

        if ($q) {
            $barang = array_values(array_filter($barang, function ($b) use ($q) {
                return stripos($b['nama'], $q) !== false || stripos($b['spesifikasi'], $q) !== false;
            }));
        }
        if ($jenisFilter) {
            $barang = array_values(array_filter($barang, fn ($b) => $b['jenis'] === $jenisFilter));
        }
        if ($unitFilter) {
            $barang = array_values(array_filter($barang, fn ($b) => $b['unit_id'] == $unitFilter));
        }

        // Pagination sederhana
        $perPage = 8;
        $page = max(1, (int) $request->query('page', 1));
        $total = count($barang);
        $totalPages = max(1, (int) ceil($total / $perPage));
        $page = min($page, $totalPages);
        $items = array_slice($barang, ($page - 1) * $perPage, $perPage);

        return view('dashboard.index', [
            'ringkasan' => DataProvider::ringkasan(),
            'jenis' => $jenis,
            'units' => DataProvider::units(),
            'items' => $items,
            'page' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'filters' => ['q' => $q, 'jenis' => $jenisFilter, 'unit' => $unitFilter],
        ]);
    }
}
