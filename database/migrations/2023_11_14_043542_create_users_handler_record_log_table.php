<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersHandlerRecordLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_handler_record_log', function (Blueprint $table) {
            $table->id('id');
            $table->string('kd_kinerja_sub');
            $table->string('id_user');
            $table->string('kd_cabang');
            $table->string('tgl_record');
            $table->string('ket_kinerja_sub');
            $table->string('status_kinerja_sub');
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
        Schema::dropIfExists('users_handler_record_log');
    }
}
