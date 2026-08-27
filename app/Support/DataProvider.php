<?php

namespace App\Support;

/**
 * LIMS Lite — Dummy Data Provider (Iterasi 1).
 *
 * Semua data bersifat statis (array) agar mudah diganti dengan Eloquent/DB
 * pada iterasi berikutnya tanpa mengubah struktur controller/views.
 */
class DataProvider
{
    /**
     * Daftar unit kerja / laboratorium.
     */
    public static function units(): array
    {
        return [
            ['id' => 1, 'kode' => 'LAB-ANATOMI', 'nama' => 'Lab Anatomi DLC Basement', 'lokasi' => 'Basement DLC', 'penanggung_jawab' => 'drg. Andini Pratiwi, M.Kes'],
            ['id' => 2, 'kode' => 'LAB-DLC1', 'nama' => 'Lab DLC Lantai 1', 'lokasi' => 'DLC Lantai 1', 'penanggung_jawab' => 'drg. Bagus Santoso, Sp.KG'],
            ['id' => 3, 'kode' => 'LAB-RAD1', 'nama' => 'Lab DLC Lantai 1 Radiologi', 'lokasi' => 'DLC Lantai 1', 'penanggung_jawab' => 'drg. Citra Nirmala, Sp.RKG'],
            ['id' => 4, 'kode' => 'LAB-SIM2', 'nama' => 'Lab DLC Lantai 2 Dental Simulator', 'lokasi' => 'DLC Lantai 2', 'penanggung_jawab' => 'drg. Dimas Ardiansyah, Sp.Pros'],
            ['id' => 5, 'kode' => 'LAB-DLC3', 'nama' => 'Lab DLC Lantai 3', 'lokasi' => 'DLC Lantai 3', 'penanggung_jawab' => 'drg. Endah Puspita, M.Biomed'],
            ['id' => 6, 'kode' => 'LAB-TER4', 'nama' => 'Lab DLC Lantai 4 Terpadu', 'lokasi' => 'DLC Lantai 4', 'penanggung_jawab' => 'drg. Farhan Maulana, Sp.Ort'],
            ['id' => 7, 'kode' => 'LAB-MIC4', 'nama' => 'Lab DLC Lantai 4 Microbia', 'lokasi' => 'DLC Lantai 4', 'penanggung_jawab' => 'drg. Gita Larasati, M.Sc'],
            ['id' => 8, 'kode' => 'LAB-PHANTOM', 'nama' => 'Lab Phantom Sutatmi Suryo', 'lokasi' => 'Gedung Sutatmi Suryo', 'penanggung_jawab' => 'drg. Haryo Wibisono, Sp.Pros'],
            ['id' => 9, 'kode' => 'LAB-DU-SS', 'nama' => 'Lab DU Sutatmi Suryo', 'lokasi' => 'Gedung Sutatmi Suryo', 'penanggung_jawab' => 'drg. Intan Permata, Sp.KG'],
            ['id' => 10, 'kode' => 'LAB-OECF5', 'nama' => 'Lab OECF Lt 5', 'lokasi' => 'OECF Lantai 5', 'penanggung_jawab' => 'drg. Joko Purnomo, M.Med.Ed'],
        ];
    }

    /**
     * Data satuan barang.
     */
    public static function satuan(): array
    {
        return [
            ['id' => 1, 'nama' => 'Botol'],
            ['id' => 2, 'nama' => 'Box'],
            ['id' => 3, 'nama' => 'Liter'],
            ['id' => 4, 'nama' => 'Kg'],
            ['id' => 5, 'nama' => 'Pcs'],
            ['id' => 6, 'nama' => 'Set'],
            ['id' => 7, 'nama' => 'Buah'],
            ['id' => 8, 'nama' => 'Jerigen'],
        ];
    }

    /**
     * Data jenis barang.
     */
    public static function jenisBarang(): array
    {
        return [
            ['id' => 1, 'nama' => 'Bahan Kimia', 'deskripsi' => 'Bahan kimia untuk praktikum dan penelitian'],
            ['id' => 2, 'nama' => 'Alat Kesehatan', 'deskripsi' => 'Peralatan kesehatan dan kedokteran gigi'],
            ['id' => 3, 'nama' => 'Bahan Habis Pakai', 'deskripsi' => 'Bahan sekali pakai (disposable)'],
            ['id' => 4, 'nama' => 'Alat Laboratorium', 'deskripsi' => 'Instrumen dan peralatan laboratorium'],
            ['id' => 5, 'nama' => 'Model & Media', 'deskripsi' => 'Model gigi dan media pembelajaran'],
            ['id' => 6, 'nama' => 'Material Kedokteran Gigi', 'deskripsi' => 'Material klinis kedokteran gigi'],
        ];
    }

    /**
     * Data jenis pengguna barang (pemanfaatan).
     */
    public static function jenisPengguna(): array
    {
        return [
            ['id' => 1, 'nama' => 'Praktikum', 'deskripsi' => 'Kegiatan praktikum mahasiswa'],
            ['id' => 2, 'nama' => 'Penelitian', 'deskripsi' => 'Kegiatan penelitian dosen/mahasiswa'],
            ['id' => 3, 'nama' => 'Pelayanan', 'deskripsi' => 'Pelayanan klinik'],
            ['id' => 4, 'nama' => 'Operasional', 'deskripsi' => 'Kebutuhan operasional lab'],
            ['id' => 5, 'nama' => 'Pengajaran', 'deskripsi' => 'Kegiatan pengajaran/ perkuliahan'],
        ];
    }

    /**
     * Data pengguna (user).
     */
    public static function users(): array
    {
        return [
            ['id' => 1, 'nama' => 'Administrator Sistem', 'username' => 'admin', 'email' => 'admin@fkg.ugm.ac.id', 'role' => 'Super Admin', 'unit_id' => null, 'status' => 'Aktif'],
            ['id' => 2, 'nama' => 'Bagian Umum FKG', 'username' => 'admin.umum', 'email' => 'umum@fkg.ugm.ac.id', 'role' => 'Admin', 'unit_id' => null, 'status' => 'Aktif'],
            ['id' => 3, 'nama' => 'Andini Pratiwi', 'username' => 'lab.anatomi', 'email' => 'anatomi@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 1, 'status' => 'Aktif'],
            ['id' => 4, 'nama' => 'Bagus Santoso', 'username' => 'lab.dlc1', 'email' => 'dlc1@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 2, 'status' => 'Aktif'],
            ['id' => 5, 'nama' => 'Citra Nirmala', 'username' => 'lab.radiologi', 'email' => 'radiologi@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 3, 'status' => 'Aktif'],
            ['id' => 6, 'nama' => 'Dimas Ardiansyah', 'username' => 'lab.simulator', 'email' => 'simulator@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 4, 'status' => 'Aktif'],
            ['id' => 7, 'nama' => 'Endah Puspita', 'username' => 'lab.dlc3', 'email' => 'dlc3@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 5, 'status' => 'Aktif'],
            ['id' => 8, 'nama' => 'Farhan Maulana', 'username' => 'lab.terpadu', 'email' => 'terpadu@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 6, 'status' => 'Aktif'],
            ['id' => 9, 'nama' => 'Gita Larasati', 'username' => 'lab.microbia', 'email' => 'microbia@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 7, 'status' => 'Aktif'],
            ['id' => 10, 'nama' => 'Haryo Wibisono', 'username' => 'lab.phantom', 'email' => 'phantom@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 8, 'status' => 'Aktif'],
            ['id' => 11, 'nama' => 'Intan Permata', 'username' => 'lab.du', 'email' => 'du@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 9, 'status' => 'Aktif'],
            ['id' => 12, 'nama' => 'Joko Purnomo', 'username' => 'lab.oecf', 'email' => 'oecf@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 10, 'status' => 'Aktif'],
            ['id' => 13, 'nama' => 'Raka Wijaya', 'username' => 'raka.mhs', 'email' => 'raka@mail.ugm.ac.id', 'role' => 'Mahasiswa', 'unit_id' => null, 'status' => 'Aktif'],
            ['id' => 14, 'nama' => 'Prof. drg. Sri Hartati, Ph.D', 'username' => 'sri.hartati', 'email' => 'sri.hartati@ugm.ac.id', 'role' => 'Dosen', 'unit_id' => null, 'status' => 'Aktif'],
            ['id' => 15, 'nama' => 'Dr. Nurul Aini, M.Sc', 'username' => 'nurul.aini', 'email' => 'nurul.aini@ugm.ac.id', 'role' => 'Peneliti', 'unit_id' => null, 'status' => 'Aktif'],
        ];
    }

    /**
     * Data supplier (kosong — dalam pengembangan).
     */
    public static function suppliers(): array
    {
        return [];
    }

    /**
     * Data barang (BHP) — 30 sampel.
     */
    public static function barang(): array
    {
        return [
            ['id' => 1, 'nama' => 'Ethanol', 'spesifikasi' => 'E Merck', 'satuan' => 'Botol', 'jenis' => 'Bahan Kimia', 'unit_id' => 1, 'stok' => 24, 'expired' => '2027-03-15', 'harga' => 85000],
            ['id' => 2, 'nama' => 'Spiritus Biru 500 ml', 'spesifikasi' => 'Biru', 'satuan' => 'Botol', 'jenis' => 'Bahan Kimia', 'unit_id' => 1, 'stok' => 18, 'expired' => '2026-12-01', 'harga' => 18000],
            ['id' => 3, 'nama' => 'Gloves Nitril, XS', 'spesifikasi' => 'Saveglove', 'satuan' => 'Box', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 2, 'stok' => 40, 'expired' => '2028-06-30', 'harga' => 95000],
            ['id' => 4, 'nama' => 'Gloves Nitril, S', 'spesifikasi' => 'Saveglove', 'satuan' => 'Box', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 2, 'stok' => 55, 'expired' => '2028-06-30', 'harga' => 95000],
            ['id' => 5, 'nama' => 'Gloves Nitril, M', 'spesifikasi' => 'Saveglove', 'satuan' => 'Box', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 2, 'stok' => 60, 'expired' => '2028-06-30', 'harga' => 95000],
            ['id' => 6, 'nama' => 'Gloves Nitril, L', 'spesifikasi' => 'Saveglove', 'satuan' => 'Box', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 2, 'stok' => 45, 'expired' => '2028-06-30', 'harga' => 95000],
            ['id' => 7, 'nama' => 'Aquades', 'spesifikasi' => 'Multilab', 'satuan' => 'Liter', 'jenis' => 'Bahan Kimia', 'unit_id' => 3, 'stok' => 120, 'expired' => null, 'harga' => 15000],
            ['id' => 8, 'nama' => 'Paraplast, Leica, 1 kg', 'spesifikasi' => 'Leica', 'satuan' => 'Kg', 'jenis' => 'Bahan Kimia', 'unit_id' => 3, 'stok' => 9, 'expired' => '2027-01-20', 'harga' => 1250000],
            ['id' => 9, 'nama' => 'Gown Medis Biru', 'spesifikasi' => '35 g', 'satuan' => 'Pcs', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 4, 'stok' => 210, 'expired' => null, 'harga' => 12000],
            ['id' => 10, 'nama' => 'Matriks Servikal', 'spesifikasi' => '-', 'satuan' => 'Set', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 4, 'stok' => 15, 'expired' => '2027-09-10', 'harga' => 150000],
            ['id' => 11, 'nama' => 'Chill Mould Sealant', 'spesifikasi' => '10 ml', 'satuan' => 'Botol', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 4, 'stok' => 8, 'expired' => '2026-11-05', 'harga' => 175000],
            ['id' => 12, 'nama' => 'Kawat Klamer', 'spesifikasi' => '0,9 mm', 'satuan' => 'Buah', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 5, 'stok' => 320, 'expired' => null, 'harga' => 4500],
            ['id' => 13, 'nama' => 'Vonflex Light Body', 'spesifikasi' => 'Vonflex', 'satuan' => 'Set', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 5, 'stok' => 22, 'expired' => '2027-02-28', 'harga' => 425000],
            ['id' => 14, 'nama' => 'Vonflex Putty', 'spesifikasi' => 'Vonflex', 'satuan' => 'Set', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 5, 'stok' => 19, 'expired' => '2027-02-28', 'harga' => 480000],
            ['id' => 15, 'nama' => 'Steril Disk Blank 6mm', 'spesifikasi' => 'HIMEDIA', 'satuan' => 'Pcs', 'jenis' => 'Alat Laboratorium', 'unit_id' => 6, 'stok' => 250, 'expired' => '2027-07-19', 'harga' => 6000],
            ['id' => 16, 'nama' => 'Masson Trichrome Goldner 100 Test', 'spesifikasi' => 'BIO OPTICA', 'satuan' => 'Pcs', 'jenis' => 'Bahan Kimia', 'unit_id' => 6, 'stok' => 7, 'expired' => '2026-10-12', 'harga' => 2400000],
            ['id' => 17, 'nama' => 'Clinical Centrifuge, Low Speed', 'spesifikasi' => 'INFITEK', 'satuan' => 'Pcs', 'jenis' => 'Alat Laboratorium', 'unit_id' => 6, 'stok' => 3, 'expired' => null, 'harga' => 8500000],
            ['id' => 18, 'nama' => 'Positive Charged Adhesive Glass Microscope Slides', 'spesifikasi' => 'ABCLONAL', 'satuan' => 'Pcs', 'jenis' => 'Alat Laboratorium', 'unit_id' => 7, 'stok' => 500, 'expired' => null, 'harga' => 3500],
            ['id' => 19, 'nama' => 'Gown Disposible Biru', 'spesifikasi' => 'BOBOT 40gr', 'satuan' => 'Pcs', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 7, 'stok' => 150, 'expired' => null, 'harga' => 15000],
            ['id' => 20, 'nama' => 'Aseptic plus Onemed', 'spesifikasi' => '5 Liter', 'satuan' => 'Jerigen', 'jenis' => 'Bahan Kimia', 'unit_id' => 7, 'stok' => 11, 'expired' => '2026-08-30', 'harga' => 130000],
            ['id' => 21, 'nama' => 'Wax Cavex regular', 'spesifikasi' => 'Cavex', 'satuan' => 'Box', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 8, 'stok' => 26, 'expired' => '2028-03-22', 'harga' => 220000],
            ['id' => 22, 'nama' => 'Fiber Splint RTD', 'spesifikasi' => 'RTD', 'satuan' => 'Box', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 8, 'stok' => 14, 'expired' => '2027-05-18', 'harga' => 310000],
            ['id' => 23, 'nama' => 'Permanent Single Root Tooth Model #14', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 9, 'stok' => 60, 'expired' => null, 'harga' => 75000],
            ['id' => 24, 'nama' => 'Permanent Single Root Tooth Model #24', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 9, 'stok' => 58, 'expired' => null, 'harga' => 75000],
            ['id' => 25, 'nama' => 'Permanent Single Root Tooth Model #44', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 9, 'stok' => 62, 'expired' => null, 'harga' => 75000],
            ['id' => 26, 'nama' => 'Permanent Single Root Tooth Model #34', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 9, 'stok' => 55, 'expired' => null, 'harga' => 75000],
            ['id' => 27, 'nama' => 'Permanent Single Root Tooth Model #16', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 10, 'stok' => 48, 'expired' => null, 'harga' => 75000],
            ['id' => 28, 'nama' => 'Permanent Single Root Tooth Model #46', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 10, 'stok' => 50, 'expired' => null, 'harga' => 75000],
            ['id' => 29, 'nama' => 'Permanent Single Root Tooth Model #36', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 10, 'stok' => 52, 'expired' => null, 'harga' => 75000],
            ['id' => 30, 'nama' => 'Permanent Single Root Tooth Model #26', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 10, 'stok' => 47, 'expired' => null, 'harga' => 75000],
        ];
    }

    /**
     * Data kartu stok per unit per semester.
     * Struktur: [unit_id, semester, tahun, [barang_id => [stok_awal, penerimaan, persediaan, pemakaian, sisa]]]
     */
    public static function kartuStok(): array
    {
        $tahunGenap = '2025/2026';
        $tahunGasal = '2026/2027';

        $stok = [];

        foreach (self::units() as $unit) {
            $unitId = $unit['id'];

            // Semester Genap
            $genap = [];
            $gasal = [];

            foreach (self::barang() as $item) {
                if ($item['unit_id'] !== $unitId) {
                    continue;
                }

                $stokAwalG = rand(20, 80);
                $penerimaanG = rand(10, 60);
                $pemakaianG = rand(5, 40);
                $sisaG = max(0, $stokAwalG + $penerimaanG - $pemakaianG);

                $genap[$item['id']] = [
                    'stok_awal' => $stokAwalG,
                    'penerimaan' => $penerimaanG,
                    'persediaan' => $stokAwalG + $penerimaanG,
                    'pemakaian' => $pemakaianG,
                    'sisa' => $sisaG,
                ];

                $stokAwalA = $sisaG;
                $penerimaanA = rand(0, 40);
                $pemakaianA = rand(0, 25);
                $sisaA = max(0, $stokAwalA + $penerimaanA - $pemakaianA);

                $gasal[$item['id']] = [
                    'stok_awal' => $stokAwalA,
                    'penerimaan' => $penerimaanA,
                    'persediaan' => $stokAwalA + $penerimaanA,
                    'pemakaian' => $pemakaianA,
                    'sisa' => $sisaA,
                ];
            }

            $stok[$unitId] = [
                ['semester' => 'Genap', 'tahun' => $tahunGenap, 'items' => $genap],
                ['semester' => 'Gasal', 'tahun' => $tahunGasal, 'items' => $gasal],
            ];
        }

        return $stok;
    }

    /**
     * Data transaksi peminjaman.
     */
    public static function peminjaman(): array
    {
        return [
            ['id' => 1, 'kode' => 'PJM-2026-001', 'tanggal' => '2026-08-20', 'peminjam' => 'Raka Wijaya', 'unit' => 'Lab DLC Lantai 2 Dental Simulator', 'barang' => 'Gloves Nitril, M', 'qty' => 2, 'pemanfaatan' => 'Praktikum', 'keterangan' => 'Praktikum KG II'],
            ['id' => 2, 'kode' => 'PJM-2026-002', 'tanggal' => '2026-08-21', 'peminjam' => 'Dr. Nurul Aini, M.Sc', 'unit' => 'Lab DLC Lantai 4 Microbia', 'barang' => 'Steril Disk Blank 6mm', 'qty' => 20, 'pemanfaatan' => 'Penelitian', 'keterangan' => 'Uji antimikroba'],
            ['id' => 3, 'kode' => 'PJM-2026-003', 'tanggal' => '2026-08-22', 'peminjam' => 'Prof. drg. Sri Hartati, Ph.D', 'unit' => 'Lab DU Sutatmi Suryo', 'barang' => 'Permanent Single Root Tooth Model #14', 'qty' => 5, 'pemanfaatan' => 'Pengajaran', 'keterangan' => 'Tutorial endodontik'],
            ['id' => 4, 'kode' => 'PJM-2026-004', 'tanggal' => '2026-08-24', 'peminjam' => 'Raka Wijaya', 'unit' => 'Lab Anatomi DLC Basement', 'barang' => 'Ethanol', 'qty' => 3, 'pemanfaatan' => 'Praktikum', 'keterangan' => 'Fiksasi preparat'],
        ];
    }

    /**
     * Data transaksi supply baru (barang masuk).
     */
    public static function supply(): array
    {
        return [
            ['id' => 1, 'kode' => 'SPL-2026-001', 'tanggal' => '2026-08-10', 'supplier' => 'PT Medika Sejahtera', 'unit' => 'Lab DLC Lantai 1', 'barang' => 'Gloves Nitril, S', 'qty' => 20, 'total' => 1900000],
            ['id' => 2, 'kode' => 'SPL-2026-002', 'tanggal' => '2026-08-15', 'supplier' => 'CV Anugerah Lab', 'unit' => 'Lab DLC Lantai 4 Microbia', 'barang' => 'Aseptic plus Onemed', 'qty' => 5, 'total' => 650000],
        ];
    }

    /**
     * Data permintaan baru.
     */
    public static function permintaan(): array
    {
        return [
            ['id' => 1, 'kode' => 'PRM-2026-001', 'tanggal' => '2026-08-18', 'pemohon' => 'Dr. Nurul Aini, M.Sc', 'unit' => 'Lab DLC Lantai 4 Microbia', 'barang' => 'Masson Trichrome Goldner 100 Test', 'qty' => 2, 'status' => 'Menunggu'],
            ['id' => 2, 'kode' => 'PRM-2026-002', 'tanggal' => '2026-08-19', 'pemohon' => 'Raka Wijaya', 'unit' => 'Lab DLC Lantai 2 Dental Simulator', 'barang' => 'Matriks Servikal', 'qty' => 3, 'status' => 'Disetujui'],
        ];
    }

    /**
     * Ringkasan untuk dashboard.
     */
    public static function ringkasan(): array
    {
        $barang = self::barang();
        $totalStok = array_sum(array_column($barang, 'stok'));

        return [
            'total_unit' => count(self::units()),
            'total_jenis_barang' => count(self::jenisBarang()),
            'total_barang' => count($barang),
            'total_stok' => $totalStok,
            'total_peminjaman' => count(self::peminjaman()),
            'expired_dekat' => count(array_filter($barang, function ($b) {
                return $b['expired'] !== null && strtotime($b['expired']) < strtotime('+90 days');
            })),
        ];
    }

    /**
     * Helper: ambil nama unit berdasarkan id.
     */
    public static function unitName(?int $id): string
    {
        foreach (self::units() as $u) {
            if ($u['id'] === $id) {
                return $u['nama'];
            }
        }

        return 'Semua Unit';
    }

    /**
     * Data analitik pemakaian bahan untuk dashboard pengelola lab.
     */
    public static function analitik(): array
    {
        $barang = self::barang();
        $kartu = self::kartuStok();
        $units = self::units();

        // 1. Tren pemakaian & penerimaan bulanan (12 bulan terakhir)
        $bulanLabels = [];
        $pemakaianBulanan = [];
        $penerimaanBulanan = [];
        for ($i = 11; $i >= 0; $i--) {
            $t = strtotime("-{$i} months");
            $bulanLabels[] = date('M', $t);
            $month = (int) date('n', $t);
            // Puncak saat awal semester (Ags-Okt & Jan-Mar)
            $season = (($month >= 8 && $month <= 10) || ($month >= 1 && $month <= 3)) ? 1 : 0;
            $pemakaianBulanan[] = 180 + ($season * 120) + rand(-40, 60);
            $penerimaanBulanan[] = 170 + ($season * 60) + rand(-30, 80);
        }

        // 2. Konsumsi per barang (akumulasi pemakaian Genap+Gasal)
        $konsumsi = [];
        foreach ($kartu as $unitId => $semesters) {
            foreach ($semesters as $semester) {
                foreach ($semester['items'] as $barangId => $s) {
                    if (!isset($konsumsi[$barangId])) {
                        $konsumsi[$barangId] = 0;
                    }
                    $konsumsi[$barangId] += $s['pemakaian'];
                }
            }
        }

        $barangMap = [];
        foreach ($barang as $b) {
            $barangMap[$b['id']] = $b;
        }

        // 3. Barang tercepat habis + proyeksi stok
        $tercepat = [];
        foreach ($konsumsi as $barangId => $totalPakai) {
            $b = $barangMap[$barangId] ?? null;
            if (!$b) {
                continue;
            }
            $stok = max(1, (int) $b['stok']);
            $ratePerBulan = max(0.5, $totalPakai / 12);
            $hariHabis = (int) round(($stok / $ratePerBulan) * 30);
            $tercepat[] = [
                'nama' => $b['nama'],
                'spesifikasi' => $b['spesifikasi'],
                'satuan' => $b['satuan'],
                'jenis' => $b['jenis'],
                'total_pakai' => $totalPakai,
                'stok' => $b['stok'],
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
            $key = $b['jenis'];
            if (!isset($jenisDistribusi[$key])) {
                $jenisDistribusi[$key] = 0;
            }
            $jenisDistribusi[$key] += $b['stok'];
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
        $totalStok = array_sum(array_column($barang, 'stok'));
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
