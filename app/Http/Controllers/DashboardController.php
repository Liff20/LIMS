<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Unit;
use App\Support\DataProvider;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jenis = DataProvider::jenisBarang();
        $units = DataProvider::units();

        $q = $request->query('q');
        $jenisFilter = $request->query('jenis');
        $unitFilter = $request->query('unit');

        $query = Barang::with(['satuan', 'jenis', 'unit'])->orderBy('id');

        if ($q) {
            $query->where(function ($w) use ($q) {
                $w->where('nama', 'like', "%{$q}%")->orWhere('spesifikasi', 'like', "%{$q}%");
            });
        }
        if ($jenisFilter) {
            $query->whereHas('jenis', fn ($w) => $w->where('nama', $jenisFilter));
        }
        if ($unitFilter) {
            $query->where('unit_id', $unitFilter);
        }

        $perPage = 8;
        $items = $query->paginate($perPage)->withQueryString();

        return view('dashboard.index', [
            'ringkasan' => DataProvider::ringkasan(),
            'jenis' => $jenis,
            'units' => $units,
            'items' => $items,
            'filters' => ['q' => $q, 'jenis' => $jenisFilter, 'unit' => $unitFilter],
        ]);
    }
}
