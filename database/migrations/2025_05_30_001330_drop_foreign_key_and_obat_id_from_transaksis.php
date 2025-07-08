<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Hapus foreign key jika ada
            $table->dropForeign(['obat_id']);

            // Baru hapus kolom
            $table->dropColumn('obat_id');
        });
    }

    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->unsignedBigInteger('obat_id')->nullable();

            $table->foreign('obat_id')->references('id')->on('obats')->onDelete('cascade');
        });
    }
};
