<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutSatuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_satus', function (Blueprint $table) {
            $table->id();
            $table->string('kd_invoice');
            $table->string('kd_barang');
            $table->integer('jumlah_barang');
            $table->string('metode_pembayaran');
            $table->bigInteger('harga_barang');
            $table->bigInteger('harga_antar')->default(0);
            $table->bigInteger('harga_total');
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
        Schema::dropIfExists('checkout_satus');
    }
}
