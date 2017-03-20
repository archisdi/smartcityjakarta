<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRwsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rw', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->integer('kota_id')->unsigned();
            $table->integer('kecamatan_id')->unsigned();
            $table->integer('kelurahan_id')->unsigned();
            $table->string('nama');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('kota_id')->references('id')->on('kota')->onDelete('cascade');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->onDelete('cascade');
            $table->foreign('kelurahan_id')->references('id')->on('kelurahan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rw');
    }
}
