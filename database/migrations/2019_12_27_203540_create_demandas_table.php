<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('iddemanda')->nullable()->comment('id de la demanda de acuerdo al catalogo de tipo de damandas');
            $table->integer('idexpediente')->comment('id del numero de expediente ');
            $table->string('idresultado')->nullable()->comment('id del resultado de la demanda de acuerdo al cataloog de resultados');
            $table->text('resultado')->nullable()->comment('observaciones del operador técnico');
            $table->boolean('de_sedacita')->nullable()->comment('se da una cita');
            $table->boolean('de_canalizacion')->nullable()->comment('canalizacion orientacion');
            $table->boolean('de_sedainformacion')->nullable()->comment('se da informacion');
            $table->boolean('de_escucha')->nullable()->comment('escucha');
            $table->boolean('de_consejo')->nullable()->comment('consejo orientacion');
            $table->string('de_otro')->nullable()->comment('otro tipo de respuesa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandas');
    }
}
