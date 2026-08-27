<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaans';

    protected $fillable = [
        'kode', 'tanggal', 'user_id', 'unit_id', 'barang_id', 'qty', 'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'qty' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
