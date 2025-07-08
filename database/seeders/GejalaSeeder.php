<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $demam = \App\Models\Gejala::create(['nama_gejala' => 'demam']);
        $batuk = \App\Models\Gejala::create(['nama_gejala' => 'batuk']);
        $sakitKepala = \App\Models\Gejala::create(['nama_gejala' => 'sakit kepala']);

        $paracetamol = \App\Models\Obat::firstOrCreate(['nama_obat' => 'Paracetamol'], ['stok' => 20, 'harga' => 5000, 'kategori' => 'Umum']);
        $bodrex = \App\Models\Obat::firstOrCreate(['nama_obat' => 'Bodrex'], ['stok' => 15, 'harga' => 6000, 'kategori' => 'Umum']);

        $paracetamol->gejalas()->attach([$demam->id, $sakitKepala->id]);
        $bodrex->gejalas()->attach([$sakitKepala->id]);
    }

}
