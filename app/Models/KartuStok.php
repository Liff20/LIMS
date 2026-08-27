<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuStok extends Model
{
    use HasFactory;

    protected $table = 'kartu_stoks';

    protected $fillable = [
        'unit_id', 'barang_id', 'semester', 'tahun',
        'stok_awal', 'penerimaan', 'persediaan', 'pemakaian', 'sisa',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
