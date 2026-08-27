<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 'tanggal', 'supplier_id', 'unit_id', 'barang_id', 'qty', 'total',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'qty' => 'integer',
        'total' => 'integer',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
