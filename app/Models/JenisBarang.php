<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'jenis_id');
    }
}
