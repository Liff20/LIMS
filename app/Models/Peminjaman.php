<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'kode', 'tanggal', 'user_id', 'unit_id', 'barang_id',
        'qty', 'pemanfaatan_id', 'keterangan',
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

    public function pemanfaatan()
    {
        return $this->belongsTo(JenisPengguna::class, 'pemanfaatan_id');
    }
}
