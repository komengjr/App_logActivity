<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersScheduleMaintenanceSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_schedule_maintenance_sub', function (Blueprint $table) {
            $table->id('id_maintenance_sub');
            $table->string('kd_schedule_maintenance');
            $table->string('id_inventaris');
            $table->string('no_inventaris');
            $table->string('nama_inventaris');
            $table->string('type_inventaris');
            $table->date('tgl_maintenance_sub');
            $table->string('status_maintenance_sub');
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
        Schema::dropIfExists('users_schedule_maintenance_sub');
    }
}
