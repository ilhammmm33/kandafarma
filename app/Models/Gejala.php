<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    protected $fillable = ['nama_gejala'];

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'gejala_obat');
    }
}

