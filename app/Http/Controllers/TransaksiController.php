<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\JenisPengguna;
use App\Models\Peminjaman;
use App\Models\Permintaan;
use App\Models\Supplier;
use App\Models\Supply;
use App\Models\Unit;
use App\Models\User;

class TransaksiController extends Controller
{
    public function peminjaman()
    {
        return view('transaksi.peminjaman', [
            'barang' => Barang::with(['satuan'])->orderBy('nama')->get(),
            'users' => User::orderBy('name')->get(),
            'pemanfaatan' => JenisPengguna::orderBy('id')->get(),
            'units' => Unit::orderBy('id')->get(),
        ]);
    }

    public function storePeminjaman(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'user_id' => 'required|integer|exists:users,id',
            'barang_id' => 'required|integer|exists:barangs,id',
            'qty' => 'required|integer|min:1',
            'pemanfaatan_id' => 'required|integer|exists:jenis_penggunas,id',
            'keterangan' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($validated['barang_id']);

        if ($barang->stok < $validated['qty']) {
            return back()->withErrors(['qty' => 'Stok tidak mencukupi. Stok tersedia: ' . $barang->stok])->withInput();
        }

        $unitId = session('selected_unit') ?: $barang->unit_id;

        $kode = 'PJM-' . date('Y') . '-' . str_pad((string) (Peminjaman::count() + 1), 3, '0', STR_PAD_LEFT);

        Peminjaman::create([
            'kode' => $kode,
            'tanggal' => $validated['tanggal'],
            'user_id' => $validated['user_id'],
            'unit_id' => $unitId,
            'barang_id' => $validated['barang_id'],
            'qty' => $validated['qty'],
            'pemanfaatan_id' => $validated['pemanfaatan_id'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        $barang->decrement('stok', $validated['qty']);

        return redirect()->route('transaksi.peminjaman')->with('success', 'Peminjaman berhasil dicatat dan stok dikurangi.');
    }

    public function dataPeminjaman()
    {
        $items = Peminjaman::with(['user', 'unit', 'barang', 'pemanfaatan'])->orderBy('id', 'desc')->get();

        return view('transaksi.data-peminjaman', ['items' => $items]);
    }

    public function supplyBaru()
    {
        return view('transaksi.supply-baru', [
            'items' => Supply::with(['supplier', 'unit', 'barang'])->orderBy('id', 'desc')->get(),
            'units' => Unit::orderBy('id')->get(),
            'suppliers' => Supplier::orderBy('nama')->get(),
            'barang' => Barang::orderBy('nama')->get(),
        ]);
    }

    public function storeSupply(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'barang_id' => 'required|integer|exists:barangs,id',
            'qty' => 'required|integer|min:1',
            'total' => 'nullable|numeric|min:0',
        ]);

        $kode = 'SPL-' . date('Y') . '-' . str_pad((string) (Supply::count() + 1), 3, '0', STR_PAD_LEFT);

        Supply::create([
            'kode' => $kode,
            'tanggal' => $validated['tanggal'],
            'supplier_id' => $validated['supplier_id'],
            'unit_id' => Barang::find($validated['barang_id'])->unit_id,
            'barang_id' => $validated['barang_id'],
            'qty' => $validated['qty'],
            'total' => $validated['total'] ?? 0,
        ]);

        Barang::find($validated['barang_id'])->increment('stok', $validated['qty']);

        return redirect()->route('transaksi.supply-baru')->with('success', 'Supply berhasil dicatat dan stok bertambah.');
    }

    public function permintaanBaru()
    {
        return view('transaksi.permintaan-baru', [
            'items' => Permintaan::with(['user', 'unit', 'barang'])->orderBy('id', 'desc')->get(),
            'units' => Unit::orderBy('id')->get(),
            'users' => User::orderBy('name')->get(),
            'barang' => Barang::orderBy('nama')->get(),
        ]);
    }

    public function storePermintaan(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'user_id' => 'required|integer|exists:users,id',
            'barang_id' => 'required|integer|exists:barangs,id',
            'qty' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        $kode = 'PRM-' . date('Y') . '-' . str_pad((string) (Permintaan::count() + 1), 3, '0', STR_PAD_LEFT);

        Permintaan::create([
            'kode' => $kode,
            'tanggal' => $validated['tanggal'],
            'user_id' => $validated['user_id'],
            'unit_id' => Barang::find($validated['barang_id'])->unit_id,
            'barang_id' => $validated['barang_id'],
            'qty' => $validated['qty'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('transaksi.permintaan-baru')->with('success', 'Permintaan berhasil dibuat.');
    }

    public function updatePermintaanStatus(Request $request, Permintaan $permintaan)
    {
        $request->validate(['status' => 'required|string']);
        $permintaan->update(['status' => $request->input('status')]);

        return redirect()->route('transaksi.permintaan-baru')->with('success', 'Status permintaan diperbarui.');
    }

    public function destroyPeminjaman(Peminjaman $peminjaman)
    {
        $peminjaman->barang?->increment('stok', $peminjaman->qty);
        $peminjaman->delete();

        return redirect()->route('transaksi.data-peminjaman')->with('success', 'Data peminjaman dihapus dan stok dikembalikan.');
    }
}
