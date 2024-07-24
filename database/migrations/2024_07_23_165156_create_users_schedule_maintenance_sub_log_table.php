<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersScheduleMaintenanceSubLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_schedule_maintenance_sub_log', function (Blueprint $table) {
            $table->id('id_maintenance_sub_log');
            $table->string('id_maintenance_sub');
            $table->string('parameter');
            $table->longText('parameter_value');
            $table->string('tgl_input');
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
        Schema::dropIfExists('users_schedule_maintenance_sub_log');
    }
}
