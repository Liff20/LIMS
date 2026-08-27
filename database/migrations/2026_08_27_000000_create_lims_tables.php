<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('lokasi')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->timestamps();
        });

        Schema::create('satuans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamps();
        });

        Schema::create('jenis_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('jenis_penggunas', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->timestamps();
        });

        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('spesifikasi')->nullable();
            $table->foreignId('satuan_id')->nullable()->constrained('satuans')->nullOnDelete();
            $table->foreignId('jenis_id')->nullable()->constrained('jenis_barangs')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->integer('stok')->default(0);
            $table->date('expired')->nullable();
            $table->unsignedBigInteger('harga')->default(0);
            $table->timestamps();
        });

        Schema::create('kartu_stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->foreignId('barang_id')->constrained('barangs')->cascadeOnDelete();
            $table->string('semester'); // Genap | Gasal
            $table->string('tahun');
            $table->integer('stok_awal')->default(0);
            $table->integer('penerimaan')->default(0);
            $table->integer('persediaan')->default(0);
            $table->integer('pemakaian')->default(0);
            $table->integer('sisa')->default(0);
            $table->timestamps();
        });

        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->date('tanggal');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('barang_id')->nullable()->constrained('barangs')->nullOnDelete();
            $table->integer('qty')->default(1);
            $table->foreignId('pemanfaatan_id')->nullable()->constrained('jenis_penggunas')->nullOnDelete();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->date('tanggal');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('barang_id')->nullable()->constrained('barangs')->nullOnDelete();
            $table->integer('qty')->default(1);
            $table->unsignedBigInteger('total')->default(0);
            $table->timestamps();
        });

        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->date('tanggal');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('barang_id')->nullable()->constrained('barangs')->nullOnDelete();
            $table->integer('qty')->default(1);
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permintaans');
        Schema::dropIfExists('supplies');
        Schema::dropIfExists('peminjamans');
        Schema::dropIfExists('kartu_stoks');
        Schema::dropIfExists('barangs');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('jenis_penggunas');
        Schema::dropIfExists('jenis_barangs');
        Schema::dropIfExists('satuans');
        Schema::dropIfExists('units');
    }
};
