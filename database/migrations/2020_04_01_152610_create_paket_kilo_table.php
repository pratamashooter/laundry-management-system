<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketKiloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_kilos', function (Blueprint $table) {
            $table->id();
            $table->string('kd_paket');
            $table->string('nama_paket');
            $table->bigInteger('harga_paket');
            $table->integer('hari_paket');
            $table->integer('min_berat_paket');
            $table->boolean('antar_jemput_paket')->default(0);
            $table->integer('id_outlet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_kilos');
    }
}
