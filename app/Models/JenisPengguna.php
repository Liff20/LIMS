<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengguna extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi'];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'pemanfaatan_id');
    }
}
