<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPiketUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_piket_user', function (Blueprint $table) {
            $table->id('id');
            $table->string('id_piket')->unique();
            $table->string('id_user');
            $table->string('kd_cabang');
            $table->string('tgl_piket');
            $table->string('status_piket');
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
        Schema::dropIfExists('tbl_piket_user');
    }
}
