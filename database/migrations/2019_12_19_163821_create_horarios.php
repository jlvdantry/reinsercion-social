<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('idgrupo')->comment('id del grupo de actividades');
            $table->integer('idactividad')->comment('id de la actividad');
            $table->string('grupo',3)->comment('grupo')->nullable();
            $table->time('horade')->comment('horario de inicio')->nullable();
            $table->time('horahasta')->comment('horario hasta')->nullable();
            $table->integer('idtallerista')->comment('id del usuario que es tallerista')->nullable();
            $table->integer('cupo')->comment('cupo del grupo')->default(0)->nullable();
            $table->integer('sesiones')->comment('numero de sesiones')->default('0')->nullable();
            $table->date('fecha01')->comment('fecha de la session 01')->nullable();
            $table->date('fecha02')->comment('fecha de la session 02')->nullable();
            $table->date('fecha03')->comment('fecha de la session 03')->nullable();
            $table->date('fecha04')->comment('fecha de la session 04')->nullable();
            $table->date('fecha05')->comment('fecha de la session 05')->nullable();
            $table->date('fecha06')->comment('fecha de la session 06')->nullable();
            $table->date('fecha07')->comment('fecha de la session 07')->nullable();
            $table->date('fecha08')->comment('fecha de la session 08')->nullable();
            $table->date('fecha09')->comment('fecha de la session 09')->nullable();
            $table->date('fecha10')->comment('fecha de la session 10')->nullable();
            $table->string('calle_h',40)->nullable()->comment('calle donde se impartira el taller')->default('');
            $table->string('exterior_h',10)->nullable()->comment('numero exterior donde se impartira el taller')->default('');
            $table->string('interior_h',10)->nullable()->comment('numero interior donde se impartira el taller')->default('');
            $table->string('colonia_h')->nullable()->comment('colonia donde se impartira el taller')->default('');
            $table->string('id_alcaldia_h')->nullable()->comment('Alcaldia donde se impartira el taller')->default('');
            $table->integer('cp_h')->nullable()->comment('Codigo postal donde se impartira el taller')->default(0);
            $table->integer('estatus')->comment('1=activo,0=inactivo')->default('0');
          }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
}
