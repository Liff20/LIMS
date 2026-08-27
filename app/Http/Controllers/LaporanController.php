<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Supply;
use App\Support\DataProvider;

class LaporanController extends Controller
{
    public function keluar(Request $request)
    {
        $q = $request->query('q');
        $dari = $request->query('dari');
        $sampai = $request->query('sampai');

        $query = Peminjaman::with(['user', 'unit', 'barang', 'pemanfaatan'])->orderBy('id', 'desc');

        if ($q) {
            $query->where(function ($w) use ($q) {
                $w->whereHas('barang', fn ($b) => $b->where('nama', 'like', "%{$q}%"))
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$q}%"));
            });
        }
        if ($dari) {
            $query->whereDate('tanggal', '>=', $dari);
        }
        if ($sampai) {
            $query->whereDate('tanggal', '<=', $sampai);
        }

        $items = $query->get();

        return view('laporan.keluar', [
            'items' => $items,
            'units' => DataProvider::units(),
            'filters' => ['q' => $q, 'dari' => $dari, 'sampai' => $sampai],
        ]);
    }

    public function masuk(Request $request)
    {
        $q = $request->query('q');
        $dari = $request->query('dari');
        $sampai = $request->query('sampai');

        $query = Supply::with(['supplier', 'unit', 'barang'])->orderBy('id', 'desc');

        if ($q) {
            $query->where(function ($w) use ($q) {
                $w->whereHas('barang', fn ($b) => $b->where('nama', 'like', "%{$q}%"))
                    ->orWhereHas('supplier', fn ($s) => $s->where('nama', 'like', "%{$q}%"));
            });
        }
        if ($dari) {
            $query->whereDate('tanggal', '>=', $dari);
        }
        if ($sampai) {
            $query->whereDate('tanggal', '<=', $sampai);
        }

        $items = $query->get();

        return view('laporan.masuk', [
            'items' => $items,
            'units' => DataProvider::units(),
            'filters' => ['q' => $q, 'dari' => $dari, 'sampai' => $sampai],
        ]);
    }
}
