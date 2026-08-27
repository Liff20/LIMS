<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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

class LimsSeeder extends Seeder
{
    public function run(): void
    {
        // ===== Unit =====
        $unitRows = [
            ['kode' => 'LAB-ANATOMI', 'nama' => 'Lab Anatomi DLC Basement', 'lokasi' => 'Basement DLC', 'penanggung_jawab' => 'drg. Andini Pratiwi, M.Kes'],
            ['kode' => 'LAB-DLC1', 'nama' => 'Lab DLC Lantai 1', 'lokasi' => 'DLC Lantai 1', 'penanggung_jawab' => 'drg. Bagus Santoso, Sp.KG'],
            ['kode' => 'LAB-RAD1', 'nama' => 'Lab DLC Lantai 1 Radiologi', 'lokasi' => 'DLC Lantai 1', 'penanggung_jawab' => 'drg. Citra Nirmala, Sp.RKG'],
            ['kode' => 'LAB-SIM2', 'nama' => 'Lab DLC Lantai 2 Dental Simulator', 'lokasi' => 'DLC Lantai 2', 'penanggung_jawab' => 'drg. Dimas Ardiansyah, Sp.Pros'],
            ['kode' => 'LAB-DLC3', 'nama' => 'Lab DLC Lantai 3', 'lokasi' => 'DLC Lantai 3', 'penanggung_jawab' => 'drg. Endah Puspita, M.Biomed'],
            ['kode' => 'LAB-TER4', 'nama' => 'Lab DLC Lantai 4 Terpadu', 'lokasi' => 'DLC Lantai 4', 'penanggung_jawab' => 'drg. Farhan Maulana, Sp.Ort'],
            ['kode' => 'LAB-MIC4', 'nama' => 'Lab DLC Lantai 4 Microbia', 'lokasi' => 'DLC Lantai 4', 'penanggung_jawab' => 'drg. Gita Larasati, M.Sc'],
            ['kode' => 'LAB-PHANTOM', 'nama' => 'Lab Phantom Sutatmi Suryo', 'lokasi' => 'Gedung Sutatmi Suryo', 'penanggung_jawab' => 'drg. Haryo Wibisono, Sp.Pros'],
            ['kode' => 'LAB-DU-SS', 'nama' => 'Lab DU Sutatmi Suryo', 'lokasi' => 'Gedung Sutatmi Suryo', 'penanggung_jawab' => 'drg. Intan Permata, Sp.KG'],
            ['kode' => 'LAB-OECF5', 'nama' => 'Lab OECF Lt 5', 'lokasi' => 'OECF Lantai 5', 'penanggung_jawab' => 'drg. Joko Purnomo, M.Med.Ed'],
        ];
        $units = [];
        foreach ($unitRows as $row) {
            $units[] = Unit::create($row);
        }

        // ===== Satuan =====
        $satuanRows = ['Botol', 'Box', 'Liter', 'Kg', 'Pcs', 'Set', 'Buah', 'Jerigen'];
        $satuans = [];
        foreach ($satuanRows as $nama) {
            $satuans[$nama] = Satuan::create(['nama' => $nama]);
        }

        // ===== Jenis Barang =====
        $jenisRows = [
            ['nama' => 'Bahan Kimia', 'deskripsi' => 'Bahan kimia untuk praktikum dan penelitian'],
            ['nama' => 'Alat Kesehatan', 'deskripsi' => 'Peralatan kesehatan dan kedokteran gigi'],
            ['nama' => 'Bahan Habis Pakai', 'deskripsi' => 'Bahan sekali pakai (disposable)'],
            ['nama' => 'Alat Laboratorium', 'deskripsi' => 'Instrumen dan peralatan laboratorium'],
            ['nama' => 'Model & Media', 'deskripsi' => 'Model gigi dan media pembelajaran'],
            ['nama' => 'Material Kedokteran Gigi', 'deskripsi' => 'Material klinis kedokteran gigi'],
        ];
        $jenis = [];
        foreach ($jenisRows as $row) {
            $jenis[$row['nama']] = JenisBarang::create($row);
        }

        // ===== Jenis Pengguna =====
        $jpRows = [
            ['nama' => 'Praktikum', 'deskripsi' => 'Kegiatan praktikum mahasiswa'],
            ['nama' => 'Penelitian', 'deskripsi' => 'Kegiatan penelitian dosen/mahasiswa'],
            ['nama' => 'Pelayanan', 'deskripsi' => 'Pelayanan klinik'],
            ['nama' => 'Operasional', 'deskripsi' => 'Kebutuhan operasional lab'],
            ['nama' => 'Pengajaran', 'deskripsi' => 'Kegiatan pengajaran/ perkuliahan'],
        ];
        $jenisPengguna = [];
        foreach ($jpRows as $row) {
            $jenisPengguna[$row['nama']] = JenisPengguna::create($row);
        }

        // ===== Supplier =====
        $supplierRows = [
            ['nama' => 'PT Medika Sejahtera', 'alamat' => 'Yogyakarta', 'telepon' => '0274-555001'],
            ['nama' => 'CV Anugerah Lab', 'alamat' => 'Yogyakarta', 'telepon' => '0274-555002'],
        ];
        $suppliers = [];
        foreach ($supplierRows as $row) {
            $suppliers[$row['nama']] = Supplier::create($row);
        }

        // ===== Users =====
        $userRows = [
            ['nama' => 'Administrator Sistem', 'username' => 'admin', 'email' => 'admin@fkg.ugm.ac.id', 'role' => 'Super Admin', 'unit_id' => null],
            ['nama' => 'Bagian Umum FKG', 'username' => 'admin.umum', 'email' => 'umum@fkg.ugm.ac.id', 'role' => 'Admin', 'unit_id' => null],
            ['nama' => 'Andini Pratiwi', 'username' => 'lab.anatomi', 'email' => 'anatomi@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 1],
            ['nama' => 'Bagus Santoso', 'username' => 'lab.dlc1', 'email' => 'dlc1@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 2],
            ['nama' => 'Citra Nirmala', 'username' => 'lab.radiologi', 'email' => 'radiologi@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 3],
            ['nama' => 'Dimas Ardiansyah', 'username' => 'lab.simulator', 'email' => 'simulator@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 4],
            ['nama' => 'Endah Puspita', 'username' => 'lab.dlc3', 'email' => 'dlc3@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 5],
            ['nama' => 'Farhan Maulana', 'username' => 'lab.terpadu', 'email' => 'terpadu@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 6],
            ['nama' => 'Gita Larasati', 'username' => 'lab.microbia', 'email' => 'microbia@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 7],
            ['nama' => 'Haryo Wibisono', 'username' => 'lab.phantom', 'email' => 'phantom@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 8],
            ['nama' => 'Intan Permata', 'username' => 'lab.du', 'email' => 'du@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 9],
            ['nama' => 'Joko Purnomo', 'username' => 'lab.oecf', 'email' => 'oecf@fkg.ugm.ac.id', 'role' => 'Admin Lab', 'unit_id' => 10],
            ['nama' => 'Raka Wijaya', 'username' => 'raka.mhs', 'email' => 'raka@mail.ugm.ac.id', 'role' => 'Mahasiswa', 'unit_id' => null],
            ['nama' => 'Prof. drg. Sri Hartati, Ph.D', 'username' => 'sri.hartati', 'email' => 'sri.hartati@ugm.ac.id', 'role' => 'Dosen', 'unit_id' => null],
            ['nama' => 'Dr. Nurul Aini, M.Sc', 'username' => 'nurul.aini', 'email' => 'nurul.aini@ugm.ac.id', 'role' => 'Peneliti', 'unit_id' => null],
        ];
        $users = [];
        foreach ($userRows as $row) {
            $users[$row['username']] = User::create([
                'name' => $row['nama'],
                'username' => $row['username'],
                'email' => $row['email'],
                'role' => $row['role'],
                'unit_id' => $row['unit_id'],
                'status' => 'Aktif',
                'password' => Hash::make('password123'),
            ]);
        }

        // ===== Barang (30 item) =====
        $barangRows = [
            ['nama' => 'Ethanol', 'spesifikasi' => 'E Merck', 'satuan' => 'Botol', 'jenis' => 'Bahan Kimia', 'unit_id' => 1, 'stok' => 24, 'expired' => '2027-03-15', 'harga' => 85000],
            ['nama' => 'Spiritus Biru 500 ml', 'spesifikasi' => 'Biru', 'satuan' => 'Botol', 'jenis' => 'Bahan Kimia', 'unit_id' => 1, 'stok' => 18, 'expired' => '2026-12-01', 'harga' => 18000],
            ['nama' => 'Gloves Nitril, XS', 'spesifikasi' => 'Saveglove', 'satuan' => 'Box', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 2, 'stok' => 40, 'expired' => '2028-06-30', 'harga' => 95000],
            ['nama' => 'Gloves Nitril, S', 'spesifikasi' => 'Saveglove', 'satuan' => 'Box', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 2, 'stok' => 55, 'expired' => '2028-06-30', 'harga' => 95000],
            ['nama' => 'Gloves Nitril, M', 'spesifikasi' => 'Saveglove', 'satuan' => 'Box', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 2, 'stok' => 60, 'expired' => '2028-06-30', 'harga' => 95000],
            ['nama' => 'Gloves Nitril, L', 'spesifikasi' => 'Saveglove', 'satuan' => 'Box', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 2, 'stok' => 45, 'expired' => '2028-06-30', 'harga' => 95000],
            ['nama' => 'Aquades', 'spesifikasi' => 'Multilab', 'satuan' => 'Liter', 'jenis' => 'Bahan Kimia', 'unit_id' => 3, 'stok' => 120, 'expired' => null, 'harga' => 15000],
            ['nama' => 'Paraplast, Leica, 1 kg', 'spesifikasi' => 'Leica', 'satuan' => 'Kg', 'jenis' => 'Bahan Kimia', 'unit_id' => 3, 'stok' => 9, 'expired' => '2027-01-20', 'harga' => 1250000],
            ['nama' => 'Gown Medis Biru', 'spesifikasi' => '35 g', 'satuan' => 'Pcs', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 4, 'stok' => 210, 'expired' => null, 'harga' => 12000],
            ['nama' => 'Matriks Servikal', 'spesifikasi' => '-', 'satuan' => 'Set', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 4, 'stok' => 15, 'expired' => '2027-09-10', 'harga' => 150000],
            ['nama' => 'Chill Mould Sealant', 'spesifikasi' => '10 ml', 'satuan' => 'Botol', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 4, 'stok' => 8, 'expired' => '2026-11-05', 'harga' => 175000],
            ['nama' => 'Kawat Klamer', 'spesifikasi' => '0,9 mm', 'satuan' => 'Buah', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 5, 'stok' => 320, 'expired' => null, 'harga' => 4500],
            ['nama' => 'Vonflex Light Body', 'spesifikasi' => 'Vonflex', 'satuan' => 'Set', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 5, 'stok' => 22, 'expired' => '2027-02-28', 'harga' => 425000],
            ['nama' => 'Vonflex Putty', 'spesifikasi' => 'Vonflex', 'satuan' => 'Set', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 5, 'stok' => 19, 'expired' => '2027-02-28', 'harga' => 480000],
            ['nama' => 'Steril Disk Blank 6mm', 'spesifikasi' => 'HIMEDIA', 'satuan' => 'Pcs', 'jenis' => 'Alat Laboratorium', 'unit_id' => 6, 'stok' => 250, 'expired' => '2027-07-19', 'harga' => 6000],
            ['nama' => 'Masson Trichrome Goldner 100 Test', 'spesifikasi' => 'BIO OPTICA', 'satuan' => 'Pcs', 'jenis' => 'Bahan Kimia', 'unit_id' => 6, 'stok' => 7, 'expired' => '2026-10-12', 'harga' => 2400000],
            ['nama' => 'Clinical Centrifuge, Low Speed', 'spesifikasi' => 'INFITEK', 'satuan' => 'Pcs', 'jenis' => 'Alat Laboratorium', 'unit_id' => 6, 'stok' => 3, 'expired' => null, 'harga' => 8500000],
            ['nama' => 'Positive Charged Adhesive Glass Microscope Slides', 'spesifikasi' => 'ABCLONAL', 'satuan' => 'Pcs', 'jenis' => 'Alat Laboratorium', 'unit_id' => 7, 'stok' => 500, 'expired' => null, 'harga' => 3500],
            ['nama' => 'Gown Disposible Biru', 'spesifikasi' => 'BOBOT 40gr', 'satuan' => 'Pcs', 'jenis' => 'Bahan Habis Pakai', 'unit_id' => 7, 'stok' => 150, 'expired' => null, 'harga' => 15000],
            ['nama' => 'Aseptic plus Onemed', 'spesifikasi' => '5 Liter', 'satuan' => 'Jerigen', 'jenis' => 'Bahan Kimia', 'unit_id' => 7, 'stok' => 11, 'expired' => '2026-08-30', 'harga' => 130000],
            ['nama' => 'Wax Cavex regular', 'spesifikasi' => 'Cavex', 'satuan' => 'Box', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 8, 'stok' => 26, 'expired' => '2028-03-22', 'harga' => 220000],
            ['nama' => 'Fiber Splint RTD', 'spesifikasi' => 'RTD', 'satuan' => 'Box', 'jenis' => 'Material Kedokteran Gigi', 'unit_id' => 8, 'stok' => 14, 'expired' => '2027-05-18', 'harga' => 310000],
            ['nama' => 'Permanent Single Root Tooth Model #14', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 9, 'stok' => 60, 'expired' => null, 'harga' => 75000],
            ['nama' => 'Permanent Single Root Tooth Model #24', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 9, 'stok' => 58, 'expired' => null, 'harga' => 75000],
            ['nama' => 'Permanent Single Root Tooth Model #44', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 9, 'stok' => 62, 'expired' => null, 'harga' => 75000],
            ['nama' => 'Permanent Single Root Tooth Model #34', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 9, 'stok' => 55, 'expired' => null, 'harga' => 75000],
            ['nama' => 'Permanent Single Root Tooth Model #16', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 10, 'stok' => 48, 'expired' => null, 'harga' => 75000],
            ['nama' => 'Permanent Single Root Tooth Model #46', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 10, 'stok' => 50, 'expired' => null, 'harga' => 75000],
            ['nama' => 'Permanent Single Root Tooth Model #36', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 10, 'stok' => 52, 'expired' => null, 'harga' => 75000],
            ['nama' => 'Permanent Single Root Tooth Model #26', 'spesifikasi' => 'Trimunt', 'satuan' => 'Pcs', 'jenis' => 'Model & Media', 'unit_id' => 10, 'stok' => 47, 'expired' => null, 'harga' => 75000],
        ];
        $barangs = [];
        foreach ($barangRows as $row) {
            $barangs[] = Barang::create([
                'nama' => $row['nama'],
                'spesifikasi' => $row['spesifikasi'],
                'satuan_id' => $satuans[$row['satuan']]->id,
                'jenis_id' => $jenis[$row['jenis']]->id,
                'unit_id' => $row['unit_id'],
                'stok' => $row['stok'],
                'expired' => $row['expired'],
                'harga' => $row['harga'],
            ]);
        }

        // ===== Kartu Stok (deterministic) =====
        mt_srand(42);
        foreach ($units as $unit) {
            foreach ($barangs as $item) {
                if ($item->unit_id !== $unit->id) {
                    continue;
                }

                $stokAwalG = rand(20, 80);
                $penerimaanG = rand(10, 60);
                $pemakaianG = rand(5, 40);
                $sisaG = max(0, $stokAwalG + $penerimaanG - $pemakaianG);

                KartuStok::create([
                    'unit_id' => $unit->id,
                    'barang_id' => $item->id,
                    'semester' => 'Genap',
                    'tahun' => '2025/2026',
                    'stok_awal' => $stokAwalG,
                    'penerimaan' => $penerimaanG,
                    'persediaan' => $stokAwalG + $penerimaanG,
                    'pemakaian' => $pemakaianG,
                    'sisa' => $sisaG,
                ]);

                $stokAwalA = $sisaG;
                $penerimaanA = rand(0, 40);
                $pemakaianA = rand(0, 25);
                $sisaA = max(0, $stokAwalA + $penerimaanA - $pemakaianA);

                KartuStok::create([
                    'unit_id' => $unit->id,
                    'barang_id' => $item->id,
                    'semester' => 'Gasal',
                    'tahun' => '2026/2027',
                    'stok_awal' => $stokAwalA,
                    'penerimaan' => $penerimaanA,
                    'persediaan' => $stokAwalA + $penerimaanA,
                    'pemakaian' => $pemakaianA,
                    'sisa' => $sisaA,
                ]);
            }
        }

        // ===== Peminjaman =====
        $peminjamanRows = [
            ['kode' => 'PJM-2026-001', 'tanggal' => '2026-08-20', 'username' => 'raka.mhs', 'unit_id' => 4, 'barang' => 'Gloves Nitril, M', 'qty' => 2, 'pemanfaatan' => 'Praktikum', 'keterangan' => 'Praktikum KG II'],
            ['kode' => 'PJM-2026-002', 'tanggal' => '2026-08-21', 'username' => 'nurul.aini', 'unit_id' => 7, 'barang' => 'Steril Disk Blank 6mm', 'qty' => 20, 'pemanfaatan' => 'Penelitian', 'keterangan' => 'Uji antimikroba'],
            ['kode' => 'PJM-2026-003', 'tanggal' => '2026-08-22', 'username' => 'sri.hartati', 'unit_id' => 9, 'barang' => 'Permanent Single Root Tooth Model #14', 'qty' => 5, 'pemanfaatan' => 'Pengajaran', 'keterangan' => 'Tutorial endodontik'],
            ['kode' => 'PJM-2026-004', 'tanggal' => '2026-08-24', 'username' => 'raka.mhs', 'unit_id' => 1, 'barang' => 'Ethanol', 'qty' => 3, 'pemanfaatan' => 'Praktikum', 'keterangan' => 'Fiksasi preparat'],
        ];
        $barangByName = collect($barangs)->keyBy('nama');
        foreach ($peminjamanRows as $row) {
            Peminjaman::create([
                'kode' => $row['kode'],
                'tanggal' => $row['tanggal'],
                'user_id' => $users[$row['username']]->id,
                'unit_id' => $row['unit_id'],
                'barang_id' => $barangByName[$row['barang']]->id,
                'qty' => $row['qty'],
                'pemanfaatan_id' => $jenisPengguna[$row['pemanfaatan']]->id,
                'keterangan' => $row['keterangan'],
            ]);
        }

        // ===== Supply =====
        $supplyRows = [
            ['kode' => 'SPL-2026-001', 'tanggal' => '2026-08-10', 'supplier' => 'PT Medika Sejahtera', 'unit_id' => 2, 'barang' => 'Gloves Nitril, S', 'qty' => 20, 'total' => 1900000],
            ['kode' => 'SPL-2026-002', 'tanggal' => '2026-08-15', 'supplier' => 'CV Anugerah Lab', 'unit_id' => 7, 'barang' => 'Aseptic plus Onemed', 'qty' => 5, 'total' => 650000],
        ];
        foreach ($supplyRows as $row) {
            Supply::create([
                'kode' => $row['kode'],
                'tanggal' => $row['tanggal'],
                'supplier_id' => $suppliers[$row['supplier']]->id,
                'unit_id' => $row['unit_id'],
                'barang_id' => $barangByName[$row['barang']]->id,
                'qty' => $row['qty'],
                'total' => $row['total'],
            ]);
        }

        // ===== Permintaan =====
        $permintaanRows = [
            ['kode' => 'PRM-2026-001', 'tanggal' => '2026-08-18', 'username' => 'nurul.aini', 'unit_id' => 7, 'barang' => 'Masson Trichrome Goldner 100 Test', 'qty' => 2, 'status' => 'Menunggu'],
            ['kode' => 'PRM-2026-002', 'tanggal' => '2026-08-19', 'username' => 'raka.mhs', 'unit_id' => 4, 'barang' => 'Matriks Servikal', 'qty' => 3, 'status' => 'Disetujui'],
        ];
        foreach ($permintaanRows as $row) {
            Permintaan::create([
                'kode' => $row['kode'],
                'tanggal' => $row['tanggal'],
                'user_id' => $users[$row['username']]->id,
                'unit_id' => $row['unit_id'],
                'barang_id' => $barangByName[$row['barang']]->id,
                'qty' => $row['qty'],
                'status' => $row['status'],
            ]);
        }
    }
}
