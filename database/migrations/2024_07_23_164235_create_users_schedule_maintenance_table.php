<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersScheduleMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_schedule_maintenance', function (Blueprint $table) {
            $table->id('id_schedule_maintenance');
            $table->string('kd_schedule_maintenance')->unique();
            $table->string('periode');
            $table->date('awal_periode');
            $table->date('akhir_periode');
            $table->string('verifikator')->nullable();
            $table->string('kd_cabang');
            $table->string('status_schedule_maintenance');
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
        Schema::dropIfExists('users_schedule_maintenance');
    }
}
