<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BMenusSub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_menus_sub', function (Blueprint $table) {
            $table->id();
            $table->string('b_menus_sub_code')->unique();
            $table->string('b_menus_code');
            $table->string('b_menus_sub_name');
            $table->string('b_menus_sub_status');
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
        Schema::dropIfExists('b_menus_sub');
    }
}
