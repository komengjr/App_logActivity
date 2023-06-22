<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTiketPersonWorklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tiket_person_worklist', function (Blueprint $table) {
            $table->id('id_tiket_worklist_person');
            $table->string('no_tiket')->unique();
            $table->string('kd_worklist_person')->index();
            $table->string('kd_kinerja')->index();
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
        Schema::dropIfExists('tbl_tiket_person_worklist');
    }
}
