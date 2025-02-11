<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiketNasionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piket_nasional', function (Blueprint $table) {
            $table->id('id_piket_nasional');
            $table->string('tiket_piket_nasional')->unique();
            $table->string('tgl_piket_nasional');
            $table->string('status_piket_nasional');
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
        Schema::dropIfExists('piket_nasional');
    }
}
