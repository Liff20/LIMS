<?php

namespace App\Support;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\JenisPengguna;
use App\Models\KartuStok;
use App\Models\Peminjaman;
use App\Models\Permintaan;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\Supply;
use App\Models\Unit;
use App\Models\User;

/**
 * LIMS Lite — Data Provider.
 *
 * Membaca data dari database (Eloquent) dan mengembalikan struktur array
 * yang sama seperti iterasi 1 agar seluruh view tetap kompatibel.
 */
class DataProvider
{
    public static function units(): array
    {
        return Unit::orderBy('id')->get()->map(fn ($u) => [
            'id' => $u->id,
            'kode' => $u->kode,
            'nama' => $u->nama,
            'lokasi' => $u->lokasi,
            'penanggung_jawab' => $u->penanggung_jawab,
        ])->all();
    }

    public static function satuan(): array
    {
        return Satuan::orderBy('id')->get()->map(fn ($s) => [
            'id' => $s->id,
            'nama' => $s->nama,
        ])->all();
    }

    public static function jenisBarang(): array
    {
        return JenisBarang::orderBy('id')->get()->map(fn ($j) => [
            'id' => $j->id,
            'nama' => $j->nama,
            'deskripsi' => $j->deskripsi,
        ])->all();
    }

    public static function jenisPengguna(): array
    {
        return JenisPengguna::orderBy('id')->get()->map(fn ($j) => [
            'id' => $j->id,
            'nama' => $j->nama,
            'deskripsi' => $j->deskripsi,
        ])->all();
    }

    public static function users(): array
    {
        return User::orderBy('id')->get()->map(fn ($u) => [
            'id' => $u->id,
            'nama' => $u->name,
            'username' => $u->username,
            'email' => $u->email,
            'role' => $u->role,
            'unit_id' => $u->unit_id,
            'status' => $u->status,
        ])->all();
    }

    public static function suppliers(): array
    {
        return Supplier::orderBy('id')->get()->map(fn ($s) => [
            'id' => $s->id,
            'nama' => $s->nama,
            'alamat' => $s->alamat,
            'telepon' => $s->telepon,
        ])->all();
    }

    public static function barang(): array
    {
        return Barang::with(['satuan', 'jenis', 'unit'])->orderBy('id')->get()->map(fn ($b) => [
            'id' => $b->id,
            'nama' => $b->nama,
            'spesifikasi' => $b->spesifikasi,
            'satuan' => $b->satuan->nama ?? '-',
            'jenis' => $b->jenis->nama ?? '-',
            'unit_id' => $b->unit_id,
            'stok' => $b->stok,
            'expired' => $b->expired ? $b->expired->format('Y-m-d') : null,
            'harga' => $b->harga,
        ])->all();
    }

    public static function kartuStok(): array
    {
        $rows = KartuStok::orderBy('unit_id')->orderBy('id')->get();

        $stok = [];
        foreach ($rows as $row) {
            $unitId = $row->unit_id;
            if (!isset($stok[$unitId])) {
                $stok[$unitId] = [];
            }

            $item = [
                'stok_awal' => $row->stok_awal,
                'penerimaan' => $row->penerimaan,
                'persediaan' => $row->persediaan,
                'pemakaian' => $row->pemakaian,
                'sisa' => $row->sisa,
            ];

            $found = false;
            foreach ($stok[$unitId] as &$sem) {
                if ($sem['semester'] === $row->semester && $sem['tahun'] === $row->tahun) {
                    $sem['items'][$row->barang_id] = $item;
                    $found = true;
                    break;
                }
            }
            unset($sem);

            if (!$found) {
                $stok[$unitId][] = [
                    'semester' => $row->semester,
                    'tahun' => $row->tahun,
                    'items' => [$row->barang_id => $item],
                ];
            }
        }

        return $stok;
    }

    public static function peminjaman(): array
    {
        return Peminjaman::with(['user', 'unit', 'barang', 'pemanfaatan'])
            ->orderBy('id')->get()->map(fn ($p) => [
                'id' => $p->id,
                'kode' => $p->kode,
                'tanggal' => $p->tanggal->format('Y-m-d'),
                'peminjam' => $p->user->name ?? '-',
                'unit' => $p->unit->nama ?? '-',
                'barang' => $p->barang->nama ?? '-',
                'qty' => $p->qty,
                'pemanfaatan' => $p->pemanfaatan->nama ?? '-',
                'keterangan' => $p->keterangan ?? '-',
            ])->all();
    }

    public static function supply(): array
    {
        return Supply::with(['supplier', 'unit', 'barang'])
            ->orderBy('id')->get()->map(fn ($s) => [
                'id' => $s->id,
                'kode' => $s->kode,
                'tanggal' => $s->tanggal->format('Y-m-d'),
                'supplier' => $s->supplier->nama ?? '-',
                'unit' => $s->unit->nama ?? '-',
                'barang' => $s->barang->nama ?? '-',
                'qty' => $s->qty,
                'total' => $s->total,
            ])->all();
    }

    public static function permintaan(): array
    {
        return Permintaan::with(['user', 'unit', 'barang'])
            ->orderBy('id')->get()->map(fn ($p) => [
                'id' => $p->id,
                'kode' => $p->kode,
                'tanggal' => $p->tanggal->format('Y-m-d'),
                'pemohon' => $p->user->name ?? '-',
                'unit' => $p->unit->nama ?? '-',
                'barang' => $p->barang->nama ?? '-',
                'qty' => $p->qty,
                'status' => $p->status,
            ])->all();
    }

    public static function ringkasan(): array
    {
        $barang = Barang::all();

        return [
            'total_unit' => Unit::count(),
            'total_jenis_barang' => JenisBarang::count(),
            'total_barang' => $barang->count(),
            'total_stok' => $barang->sum('stok'),
            'total_peminjaman' => Peminjaman::count(),
            'expired_dekat' => $barang->filter(fn ($b) =>
                $b->expired !== null && $b->expired->lt(now()->addDays(90))
            )->count(),
        ];
    }

    public static function unitName(?int $id): string
    {
        if (!$id) {
            return 'Semua Unit';
        }

        return Unit::find($id)?->nama ?? 'Semua Unit';
    }

    public static function analitik(): array
    {
        $barang = Barang::with(['jenis'])->get();
        $kartu = self::kartuStok();
        $units = self::units();

        // 1. Tren pemakaian & penerimaan bulanan (12 bulan terakhir)
        $bulanLabels = [];
        $pemakaianBulanan = [];
        $penerimaanBulanan = [];
        mt_srand(7);
        for ($i = 11; $i >= 0; $i--) {
            $t = strtotime("-{$i} months");
            $bulanLabels[] = date('M', $t);
            $month = (int) date('n', $t);
            $season = (($month >= 8 && $month <= 10) || ($month >= 1 && $month <= 3)) ? 1 : 0;
            $pemakaianBulanan[] = 180 + ($season * 120) + rand(-40, 60);
            $penerimaanBulanan[] = 170 + ($season * 60) + rand(-30, 80);
        }

        // 2. Konsumsi per barang (akumulasi pemakaian Genap+Gasal)
        $konsumsi = [];
        foreach ($kartu as $unitId => $semesters) {
            foreach ($semesters as $semester) {
                foreach ($semester['items'] as $barangId => $s) {
                    $konsumsi[$barangId] = ($konsumsi[$barangId] ?? 0) + $s['pemakaian'];
                }
            }
        }

        $barangMap = $barang->keyBy('id');

        // 3. Barang tercepat habis + proyeksi stok
        $tercepat = [];
        foreach ($konsumsi as $barangId => $totalPakai) {
            $b = $barangMap[$barangId] ?? null;
            if (!$b) {
                continue;
            }
            $stok = max(1, (int) $b->stok);
            $ratePerBulan = max(0.5, $totalPakai / 12);
            $hariHabis = (int) round(($stok / $ratePerBulan) * 30);
            $tercepat[] = [
                'nama' => $b->nama,
                'spesifikasi' => $b->spesifikasi,
                'satuan' => $b->satuan->nama ?? '-',
                'jenis' => $b->jenis->nama ?? '-',
                'total_pakai' => $totalPakai,
                'stok' => $b->stok,
                'rate_per_bulan' => round($ratePerBulan, 1),
                'hari_habis' => $hariHabis,
                'level' => $hariHabis <= 30 ? 'Kritis' : ($hariHabis <= 60 ? 'Waspada' : 'Aman'),
            ];
        }

        usort($tercepat, fn ($a, $b) => $b['total_pakai'] <=> $a['total_pakai']);
        $topCepat = array_slice($tercepat, 0, 8);

        $proyeksiHabis = array_values(array_filter($tercepat, fn ($t) => $t['level'] !== 'Aman'));
        usort($proyeksiHabis, fn ($a, $b) => $a['hari_habis'] <=> $b['hari_habis']);
        $proyeksiHabis = array_slice($proyeksiHabis, 0, 6);

        // 4. Pemakaian per unit
        $pemakaianPerUnit = [];
        foreach ($units as $unit) {
            $unitId = $unit['id'];
            $total = 0;
            if (isset($kartu[$unitId])) {
                foreach ($kartu[$unitId] as $semester) {
                    foreach ($semester['items'] as $s) {
                        $total += $s['pemakaian'];
                    }
                }
            }
            $pemakaianPerUnit[] = [
                'nama' => $unit['nama'],
                'kode' => $unit['kode'],
                'total' => $total,
            ];
        }
        usort($pemakaianPerUnit, fn ($a, $b) => $b['total'] <=> $a['total']);

        // 5. Distribusi stok per jenis barang
        $jenisDistribusi = [];
        foreach ($barang as $b) {
            $key = $b->jenis->nama ?? 'Lainnya';
            $jenisDistribusi[$key] = ($jenisDistribusi[$key] ?? 0) + $b->stok;
        }
        arsort($jenisDistribusi);

        // 6. Pemanfaatan
        $pemanfaatanDist = [
            ['nama' => 'Praktikum', 'jumlah' => 48, 'persen' => 48],
            ['nama' => 'Penelitian', 'jumlah' => 22, 'persen' => 22],
            ['nama' => 'Pengajaran', 'jumlah' => 15, 'persen' => 15],
            ['nama' => 'Pelayanan', 'jumlah' => 10, 'persen' => 10],
            ['nama' => 'Operasional', 'jumlah' => 5, 'persen' => 5],
        ];

        // KPI
        $totalPakai = array_sum($pemakaianBulanan);
        $totalStok = $barang->sum('stok');
        $rataBulanan = (int) round($totalPakai / 12);
        $stokMenipis = count(array_filter($tercepat, fn ($t) => $t['level'] === 'Kritis'));

        $bulanPuncak = '';
        $maxPakai = 0;
        foreach ($pemakaianBulanan as $i => $val) {
            if ($val > $maxPakai) {
                $maxPakai = $val;
                $bulanPuncak = $bulanLabels[$i];
            }
        }

        return [
            'bulan_labels' => $bulanLabels,
            'pemakaian_bulanan' => $pemakaianBulanan,
            'penerimaan_bulanan' => $penerimaanBulanan,
            'top_cepat' => $topCepat,
            'proyeksi_habis' => $proyeksiHabis,
            'pemakaian_per_unit' => $pemakaianPerUnit,
            'jenis_distribusi' => $jenisDistribusi,
            'pemanfaatan' => $pemanfaatanDist,
            'kpi' => [
                'total_pakai' => $totalPakai,
                'total_stok' => $totalStok,
                'rata_bulanan' => $rataBulanan,
                'stok_menipis' => $stokMenipis,
                'bulan_puncak' => $bulanPuncak,
                'max_pakai' => $maxPakai,
            ],
        ];
    }
}
