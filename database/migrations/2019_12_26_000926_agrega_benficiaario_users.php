<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregaBenficiaarioUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
              $table->smallInteger('tipodealta')->nullable()->default(0)->comment('1=Persona egresada del Sistema de Justicia Penal,2=Prevención en comunidades');
              $table->Integer('idacercamiento')->nullable()->default(0)->comment('id de la modalidad de acercamiento catalogo acercamientos');
              $table->Integer('identeros')->nullable()->default(0)->comment('id de como se entero del instituto o programa catalogo comoseenteros');
              $table->string('curp',18)->nullable()->default(0)->comment('curp del beneficiario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
