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
              $table->date('nacimiento')->nullable()->comment('fecha de nacimiento');
              $table->integer('idetnia')->nullable()->default(0)->comment('id de la pertenencia etnica de acuerdo al catalogo de etnias');
              $table->integer('idestudio')->nullable()->default(0)->comment('id del grado maximo de estudiso acuerdo al catalogo de estudios');
              $table->integer('idocupacion')->nullable()->default(0)->comment('id de la ocupacion acuerdo al catalogo de ocupaciones');
              $table->integer('identidad')->nullable()->default(0)->comment('id entidad de registro acuerdo al catalogo de entidades');
              $table->integer('idecivil')->nullable()->default(0)->comment('id del estado civil del beneficiairo acuerdo al catalogo de eciviles');
              $table->smallInteger('hijos')->nullable()->default(0)->comment('Número de hijos del beneficiario');
              $table->string('edades')->nullable()->default('')->comment('Edades de los hijos separados por comas');
              $table->string('alias')->nullable()->default('')->comment('Otros nombres o alias del beneficiario');
              $table->smallInteger('tiporesidencia')->nullable()->default(0)->comment('1=Domicilio particular,2=Albergue,3=Situación de calles');
            $table->string('calle_b',40)->nullable()->comment('calle donde se impartira el taller')->default('');
            $table->string('exterior_b',10)->nullable()->comment('numero exterior donde se impartira el taller')->default('');
            $table->string('interior_b',10)->nullable()->comment('numero interior donde se impartira el taller')->default('');
            $table->string('colonia_b')->nullable()->comment('colonia donde se impartira el taller')->default('');
            $table->string('id_alcaldia_b')->nullable()->comment('Alcaldia donde se impartira el taller')->default('');
            $table->integer('cp_b')->nullable()->comment('Codigo postal donde se impartira el taller')->default(0);
            $table->string('unidad')->nullable()->comment('Unidad territorial')->default('');
            $table->double('telfijo',10,0)->nullable()->comment('Numero de telefono fijoa')->default(0);
            $table->string('nombres_c')->nullable()->comment('Nombre de contacto')->default('');
            $table->string('parentesco_c')->nullable()->comment('Parentesco de contacto')->default('');
            $table->double('tel_c',10,0)->nullable()->comment('Telefono del contacto')->default(0);
            $table->string('calle_c',40)->nullable()->comment('calle del contacto')->default('');
            $table->string('exterior_c',10)->nullable()->comment('numero exterior del contacto')->default('');
            $table->string('interior_c',10)->nullable()->comment('numero interior del contacto')->default('');
            $table->string('colonia_c')->nullable()->comment('colonia del contacto')->default('');
            $table->string('id_alcaldia_c')->nullable()->comment('Alcaldia del contacto')->default('');
            $table->integer('cp_c')->nullable()->comment('Codigo postal del contacto')->default(0);


        });
    }
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
               $table->dropColumn('tipodealta');
               $table->dropColumn('idacercamiento');
               $table->dropColumn('identeros');
               $table->dropColumn('curp');
               $table->dropColumn('nacimiento');
               $table->dropColumn('idetnia');
               $table->dropColumn('idestudio');
               $table->dropColumn('idocupacion');
               $table->dropColumn('identidad');
               $table->dropColumn('idecivil');
               $table->dropColumn('hijos');
               $table->dropColumn('edades');
               $table->dropColumn('alias');
               $table->dropColumn('tiporesidencia');
            $table->dropColumn('calle_b');
            $table->dropColumn('exterior_b');
            $table->dropColumn('interior_b');
            $table->dropColumn('colonia_b');
            $table->dropColumn('id_alcaldia_b');
            $table->dropColumn('cp_b');
            $table->dropColumn('unidad');
            $table->dropColumn('telfijo');
            $table->dropColumn('nombres_c');
            $table->dropColumn('parentesco_c');
            $table->dropColumn('tel_c');
            $table->dropColumn('calle_c');
            $table->dropColumn('exterior_c');
            $table->dropColumn('interior_c');
            $table->dropColumn('colonia_c');
            $table->dropColumn('id_alcaldia_c');
            $table->dropColumn('cp_c');

        });
    }
}
