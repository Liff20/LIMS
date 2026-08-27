<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Satuan;
use App\Models\Unit;
use App\Support\DataProvider;

class BarangController extends Controller
{
    public function berdasarkanUnit()
    {
        $units = Unit::orderBy('id')->get();
        $kartu = DataProvider::kartuStok();

        $data = [];
        foreach ($units as $unit) {
            $data[] = [
                'unit' => [
                    'id' => $unit->id,
                    'kode' => $unit->kode,
                    'nama' => $unit->nama,
                    'lokasi' => $unit->lokasi,
                    'penanggung_jawab' => $unit->penanggung_jawab,
                ],
                'items' => Barang::with(['satuan', 'jenis'])->where('unit_id', $unit->id)
                    ->orderBy('id')->get()->map(fn ($b) => [
                        'id' => $b->id,
                        'nama' => $b->nama,
                        'spesifikasi' => $b->spesifikasi,
                        'satuan' => $b->satuan->nama ?? '-',
                        'jenis' => $b->jenis->nama ?? '-',
                        'unit_id' => $b->unit_id,
                        'stok' => $b->stok,
                    ])->all(),
                'kartu' => $kartu[$unit->id] ?? [],
            ];
        }

        return view('barang.unit', ['data' => $data]);
    }

    public function semua(Request $request)
    {
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

        $perPage = 10;
        $items = $query->paginate($perPage)->withQueryString();

        return view('barang.semua', [
            'items' => $items,
            'jenis' => JenisBarang::orderBy('id')->get(),
            'units' => Unit::orderBy('id')->get(),
            'filters' => ['q' => $q, 'jenis' => $jenisFilter, 'unit' => $unitFilter],
        ]);
    }

    public function expire()
    {
        $barang = Barang::with(['satuan', 'jenis', 'unit'])
            ->whereNotNull('expired')
            ->orderBy('expired')
            ->get()
            ->map(fn ($b) => [
                'id' => $b->id,
                'nama' => $b->nama,
                'spesifikasi' => $b->spesifikasi,
                'satuan' => $b->satuan->nama ?? '-',
                'jenis' => $b->jenis->nama ?? '-',
                'unit' => $b->unit->nama ?? '-',
                'stok' => $b->stok,
                'expired' => $b->expired->format('Y-m-d'),
                'hari_sisa' => $b->expired->diffInDays(now(), false),
            ]);

        return view('barang.expire', ['items' => $barang]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'spesifikasi' => 'nullable|string',
            'satuan_id' => 'required|integer|exists:satuans,id',
            'jenis_id' => 'required|integer|exists:jenis_barangs,id',
            'unit_id' => 'required|integer|exists:units,id',
            'stok' => 'required|integer|min:0',
            'expired' => 'nullable|date',
            'harga' => 'nullable|numeric|min:0',
        ]);

        Barang::create($data);

        return redirect()->route('barang.semua')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'spesifikasi' => 'nullable|string',
            'satuan_id' => 'required|integer|exists:satuans,id',
            'jenis_id' => 'required|integer|exists:jenis_barangs,id',
            'unit_id' => 'required|integer|exists:units,id',
            'stok' => 'required|integer|min:0',
            'expired' => 'nullable|date',
            'harga' => 'nullable|numeric|min:0',
        ]);

        $barang->update($data);

        return redirect()->route('barang.semua')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.semua')->with('success', 'Barang berhasil dihapus.');
    }
}
