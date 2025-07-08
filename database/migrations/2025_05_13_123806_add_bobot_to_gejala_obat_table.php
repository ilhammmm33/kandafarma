<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('gejala_obat', function (Blueprint $table) {
            $table->float('bobot')->default(1.0)->after('obat_id');
        });
    }

    public function down()
    {
        Schema::table('gejala_obat', function (Blueprint $table) {
            $table->dropColumn('bobot');
        });
    }

};
