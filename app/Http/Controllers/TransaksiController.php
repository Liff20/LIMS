<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\DataProvider;

class TransaksiController extends Controller
{
    public function peminjaman()
    {
        return view('transaksi.peminjaman', [
            'barang' => DataProvider::barang(),
            'users' => DataProvider::users(),
            'pemanfaatan' => DataProvider::jenisPengguna(),
            'units' => DataProvider::units(),
        ]);
    }

    public function storePeminjaman(Request $request)
    {
        // Iterasi 1: dummy — simpan ke session agar tampil di Data Peminjaman.
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'peminjam' => 'required|string',
            'barang' => 'required|string',
            'qty' => 'required|integer|min:1',
            'pemanfaatan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $list = session('peminjaman_baru', []);
        array_unshift($list, [
            'id' => count($list) + 100,
            'kode' => 'PJM-2026-' . str_pad(count($list) + 5, 3, '0', STR_PAD_LEFT),
            'tanggal' => $validated['tanggal'],
            'peminjam' => $validated['peminjam'],
            'unit' => DataProvider::unitName(session('selected_unit')),
            'barang' => $validated['barang'],
            'qty' => (int) $validated['qty'],
            'pemanfaatan' => $validated['pemanfaatan'],
            'keterangan' => $validated['keterangan'] ?? '-',
        ]);
        session(['peminjaman_baru' => $list]);

        return redirect()->route('transaksi.peminjaman')->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function dataPeminjaman()
    {
        $items = array_merge(session('peminjaman_baru', []), DataProvider::peminjaman());

        return view('transaksi.data-peminjaman', ['items' => $items]);
    }

    public function supplyBaru()
    {
        return view('transaksi.supply-baru', ['items' => DataProvider::supply(), 'units' => DataProvider::units()]);
    }

    public function permintaanBaru()
    {
        return view('transaksi.permintaan-baru', ['items' => DataProvider::permintaan(), 'units' => DataProvider::units()]);
    }

    // Placeholder pages
    public function placeholder(string $view, string $title)
    {
        return view($view, ['title' => $title]);
    }
}
