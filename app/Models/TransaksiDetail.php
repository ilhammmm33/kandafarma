<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_details';

    // ✅ Izinkan mass assignment
    protected $fillable = [
        'transaksi_id',
        'obat_id',
        'jumlah',
        'harga_jual',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
