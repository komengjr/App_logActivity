<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_menus', function (Blueprint $table) {
            $table->id();
            $table->string('b_menus_code')->unique(); // "Kategori A (Billing)" atau "Kategori B (CS)"
            $table->string('b_menus_kategori'); // "Kategori A (Billing)" atau "Kategori B (CS)"
            $table->string('b_menus_status'); // "A" atau "B"
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
        Schema::dropIfExists('b_menus');
    }
}
