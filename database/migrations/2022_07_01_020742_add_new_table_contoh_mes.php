<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableContohMes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contoh_mes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_tiket')->nullable();
            $table->string('kode_transaksi')->nullable();
            $table->string('nama_diklat')->nullable();
            $table->string('instansi')->nullable();
            $table->string('nama_mes')->nullable();
            $table->string('nama_peserta')->nullable();
            $table->double('nominal')->nullable();
            $table->string('npwp')->nullable();
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
        Schema::dropIfExists('contoh_mes');
    }
}
