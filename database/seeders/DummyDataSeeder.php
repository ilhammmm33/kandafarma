<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gejala;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Gejala
        $gejalas = [
            'demam', 'batuk', 'sakit kepala', 'mual', 'pilek', 'flu', 'nyeri otot', 'diare', 'sakit tenggorokan'
        ];

        foreach ($gejalas as $nama) {
            Gejala::firstOrCreate(['nama_gejala' => $nama]);
        }

        // 2. Data Obat
        $obats = [
            ['nama_obat' => 'Paracetamol', 'stok' => 50, 'harga' => 5000, 'kategori' => 'Umum'],
            ['nama_obat' => 'Bodrex', 'stok' => 40, 'harga' => 6000, 'kategori' => 'Umum'],
            ['nama_obat' => 'OBH Combi', 'stok' => 30, 'harga' => 7000, 'kategori' => 'Batuk'],
            ['nama_obat' => 'Diapet', 'stok' => 20, 'harga' => 8000, 'kategori' => 'Pencernaan']
        ];

        foreach ($obats as $data) {
            Obat::firstOrCreate(['nama_obat' => $data['nama_obat']], $data);
        }

        // 3. Relasi gejala_obat (pivot)
        $relasi = [
            'Paracetamol' => ['demam', 'nyeri otot', 'sakit kepala'],
            'Bodrex'      => ['sakit kepala', 'mual'],
            'OBH Combi'   => ['batuk', 'pilek', 'sakit tenggorokan'],
            'Diapet'      => ['diare', 'mual'],
        ];

        foreach ($relasi as $obatNama => $gejalaList) {
            $obat = Obat::where('nama_obat', $obatNama)->first();
            $gejalaIds = Gejala::whereIn('nama_gejala', $gejalaList)->pluck('id');
            $obat->gejalas()->syncWithoutDetaching($gejalaIds);
        }

        $this->command->info('Dummy data berhasil di-seed ke gejalas, obats, dan gejala_obat!');
    }
}
