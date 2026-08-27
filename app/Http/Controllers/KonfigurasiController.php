<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\JenisBarang;
use App\Models\JenisPengguna;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;

class KonfigurasiController extends Controller
{
    // ===================== UNIT =====================
    public function unit()
    {
        return view('konfigurasi.unit', ['items' => Unit::orderBy('id')->get()]);
    }

    public function unitStore(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|string|unique:units,kode',
            'nama' => 'required|string',
            'lokasi' => 'nullable|string',
            'penanggung_jawab' => 'nullable|string',
        ]);

        Unit::create($data);

        return redirect()->route('konfigurasi.unit')->with('success', 'Unit berhasil ditambahkan.');
    }

    public function unitUpdate(Request $request, Unit $unit)
    {
        $data = $request->validate([
            'kode' => 'required|string|unique:units,kode,' . $unit->id,
            'nama' => 'required|string',
            'lokasi' => 'nullable|string',
            'penanggung_jawab' => 'nullable|string',
        ]);

        $unit->update($data);

        return redirect()->route('konfigurasi.unit')->with('success', 'Unit berhasil diperbarui.');
    }

    public function unitDestroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('konfigurasi.unit')->with('success', 'Unit berhasil dihapus.');
    }

    // ===================== SATUAN =====================
    public function satuan()
    {
        return view('konfigurasi.satuan', ['items' => Satuan::orderBy('id')->get()]);
    }

    public function satuanStore(Request $request)
    {
        $data = $request->validate(['nama' => 'required|string|unique:satuans,nama']);
        Satuan::create($data);

        return redirect()->route('konfigurasi.satuan')->with('success', 'Satuan berhasil ditambahkan.');
    }

    public function satuanUpdate(Request $request, Satuan $satuan)
    {
        $data = $request->validate(['nama' => 'required|string|unique:satuans,nama,' . $satuan->id]);
        $satuan->update($data);

        return redirect()->route('konfigurasi.satuan')->with('success', 'Satuan berhasil diperbarui.');
    }

    public function satuanDestroy(Satuan $satuan)
    {
        $satuan->delete();

        return redirect()->route('konfigurasi.satuan')->with('success', 'Satuan berhasil dihapus.');
    }

    // ===================== JENIS BARANG =====================
    public function jenisBarang()
    {
        return view('konfigurasi.jenis-barang', ['items' => JenisBarang::orderBy('id')->get()]);
    }

    public function jenisBarangStore(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|unique:jenis_barangs,nama',
            'deskripsi' => 'nullable|string',
        ]);
        JenisBarang::create($data);

        return redirect()->route('konfigurasi.jenis-barang')->with('success', 'Jenis barang berhasil ditambahkan.');
    }

    public function jenisBarangUpdate(Request $request, JenisBarang $jenisBarang)
    {
        $data = $request->validate([
            'nama' => 'required|string|unique:jenis_barangs,nama,' . $jenisBarang->id,
            'deskripsi' => 'nullable|string',
        ]);
        $jenisBarang->update($data);

        return redirect()->route('konfigurasi.jenis-barang')->with('success', 'Jenis barang berhasil diperbarui.');
    }

    public function jenisBarangDestroy(JenisBarang $jenisBarang)
    {
        $jenisBarang->delete();

        return redirect()->route('konfigurasi.jenis-barang')->with('success', 'Jenis barang berhasil dihapus.');
    }

    // ===================== JENIS PENGGUNA =====================
    public function jenisPengguna()
    {
        return view('konfigurasi.jenis-pengguna', ['items' => JenisPengguna::orderBy('id')->get()]);
    }

    public function jenisPenggunaStore(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|unique:jenis_penggunas,nama',
            'deskripsi' => 'nullable|string',
        ]);
        JenisPengguna::create($data);

        return redirect()->route('konfigurasi.jenis-pengguna')->with('success', 'Jenis penggunaan berhasil ditambahkan.');
    }

    public function jenisPenggunaUpdate(Request $request, JenisPengguna $jenisPengguna)
    {
        $data = $request->validate([
            'nama' => 'required|string|unique:jenis_penggunas,nama,' . $jenisPengguna->id,
            'deskripsi' => 'nullable|string',
        ]);
        $jenisPengguna->update($data);

        return redirect()->route('konfigurasi.jenis-pengguna')->with('success', 'Jenis penggunaan berhasil diperbarui.');
    }

    public function jenisPenggunaDestroy(JenisPengguna $jenisPengguna)
    {
        $jenisPengguna->delete();

        return redirect()->route('konfigurasi.jenis-pengguna')->with('success', 'Jenis penggunaan berhasil dihapus.');
    }

    // ===================== PENGGUNA =====================
    public function pengguna()
    {
        $q = request('q');
        $query = User::with('unit')->orderBy('id');
        if ($q) {
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                    ->orWhere('username', 'like', "%{$q}%")
                    ->orWhere('role', 'like', "%{$q}%");
            });
        }
        $items = $query->get();

        return view('konfigurasi.pengguna', [
            'items' => $items,
            'units' => Unit::orderBy('id')->get(),
            'q' => $q,
        ]);
    }

    public function penggunaStore(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'unit_id' => 'nullable|integer|exists:units,id',
            'status' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $data['nama'],
            'username' => $data['username'],
            'email' => $data['email'],
            'role' => $data['role'],
            'unit_id' => $data['unit_id'] ?: null,
            'status' => $data['status'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('konfigurasi.pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function penggunaUpdate(Request $request, User $user)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'unit_id' => 'nullable|integer|exists:units,id',
            'status' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $data['nama'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->unit_id = $data['unit_id'] ?: null;
        $user->status = $data['status'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return redirect()->route('konfigurasi.pengguna')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function penggunaDestroy(User $user)
    {
        $user->delete();

        return redirect()->route('konfigurasi.pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }

    // ===================== SUPPLIER =====================
    public function supplier()
    {
        return view('konfigurasi.supplier', ['items' => Supplier::orderBy('id')->get()]);
    }

    public function supplierStore(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
        ]);
        Supplier::create($data);

        return redirect()->route('konfigurasi.supplier')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function supplierUpdate(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
        ]);
        $supplier->update($data);

        return redirect()->route('konfigurasi.supplier')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function supplierDestroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('konfigurasi.supplier')->with('success', 'Supplier berhasil dihapus.');
    }
}
