<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatRekomendasiTable extends Migration
{
    public function up()
    {
        Schema::create('riwayat_rekomendasi', function (Blueprint $table) {
            $table->id();
            $table->char('user_token', 36);
            $table->unsignedBigInteger('obat_id');
            $table->double('score', 8, 2);
            $table->tinyInteger('feedback')->nullable();
            $table->timestamps();

            $table->foreign('obat_id')->references('id')->on('obat')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_rekomendasi');
    }
}