<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTiketMandiri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tiket_mandiri', function (Blueprint $table) {
            $table->id('id_tiket_mandiri');
            $table->string('no_tiket')->unique();
            $table->string('id_user')->index();
            $table->string('kd_cabang')->index();
            $table->longtext('deskripsi_tugas');
            $table->string('tgl_buat');
            $table->string('user_pembuat');
            $table->string('status');
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
        Schema::dropIfExists('tbl_tiket_mandiri');
    }
}
