<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PoneFechasNulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('horarios', function (Blueprint $table) {
              $table->string('fecha01')->nullable()->change();
              $table->string('fecha02')->nullable()->change();
              $table->string('fecha03')->nullable()->change();
              $table->string('fecha04')->nullable()->change();
              $table->string('fecha05')->nullable()->change();
              $table->string('fecha06')->nullable()->change();
              $table->string('fecha07')->nullable()->change();
              $table->string('fecha08')->nullable()->change();
              $table->string('fecha09')->nullable()->change();
              $table->string('fecha10')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('horarios', function (Blueprint $table) {
            //
        });
    }
}
