<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorklistPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worklist_person', function (Blueprint $table) {
            $table->id('id_worklist_person');
            $table->string('kd_worklist_person')->unique();
            $table->string('id_user')->index();
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
        Schema::dropIfExists('worklist_person');
    }
}
