<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTiketGroupWorklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tiket_group_worklist', function (Blueprint $table) {
            $table->id('id_tiket_group_worklist');
            $table->string('no_tiket')->unique();
            $table->string('kd_group')->index();
            $table->string('id_user')->index();
            $table->string('status_tiket')->nullable();
            $table->string('tgl_buat')->nullable();
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
        Schema::dropIfExists('tbl_tiket_group_worklist');
    }
}
