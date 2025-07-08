<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['obat_id', 'jumlah', 'total_harga'];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}

