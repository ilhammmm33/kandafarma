<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obats';

    protected $fillable = [
        'kode_barang',
        'barang',
        'kategori',
        'deskripsi',
        'stok',
        'harga_pokok',
        'harga_jual',
        'komposisi',
        'foto'
    ];
    public function gejalas()
    {
        return $this->belongsToMany(Gejala::class, 'gejala_obat');
    }
    public function riwayatRekomendasi()
    {
        return $this->hasMany(RiwayatRekomendasi::class, 'obat_id');
    }
}
