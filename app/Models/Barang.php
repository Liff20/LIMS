<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'spesifikasi', 'satuan_id', 'jenis_id', 'unit_id',
        'stok', 'expired', 'harga',
    ];

    protected $casts = [
        'expired' => 'date',
        'stok' => 'integer',
        'harga' => 'integer',
    ];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function kartuStoks()
    {
        return $this->hasMany(KartuStok::class);
    }
}
