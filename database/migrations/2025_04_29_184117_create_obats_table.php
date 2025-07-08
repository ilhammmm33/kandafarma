<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_barang')->unique();
            $table->string('barang', 50); // sebelumnya nama_obat
            $table->string('kategori', 25);
            $table->string('deskripsi', 255);
            $table->integer('stok')->default(0);
            $table->string('satuan')->default(0);
            $table->string('harga_pokok', 7);
            $table->string('harga_jual', 7);
            $table->string('foto', 25);
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
