<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblWorklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_worklist', function (Blueprint $table) {
            $table->id('id_worklist');
            $table->string('kd_worklist')->unique();
            $table->string('nama_worklist');
            $table->string('type_worklist')->index();
            $table->integer('jenis_worklist');
            $table->string('point_worklist');
            $table->string('status_worklist')->nullable();
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
        Schema::dropIfExists('tbl_worklist');
    }
}
