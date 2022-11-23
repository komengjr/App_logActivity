<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupWorklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_worklist', function (Blueprint $table) {
            $table->id('id_group_worklist');
            $table->string('kd_worklist_group')->unique();
            $table->string('kd_group')->index();
            $table->string('kd_worklist')->index();
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
        Schema::dropIfExists('group_worklist');
    }
}
