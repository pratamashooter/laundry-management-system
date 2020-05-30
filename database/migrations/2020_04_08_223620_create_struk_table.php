<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('struks', function (Blueprint $table) {
            $table->id();
            $table->string('kd_invoice');
            $table->bigInteger('harga_total');
            $table->bigInteger('harga_bayar');
            $table->bigInteger('harga_kembali');
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
        Schema::dropIfExists('struks');
    }
}
