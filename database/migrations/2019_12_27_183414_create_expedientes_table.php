<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('carnet',20)->comment('Número de carnet');
            $table->integer('idsituacionjuridica')->nullable()->comment('id de la situación juridica de acuerdo al catalogo de situaciones juridicas');
            $table->integer('idtipodesituacion')->nullable()->comment('id del tipo de situación de acuerdo al catalogo de tipo de situaciones');
            $table->string('delito')->comment('delito')->nullable();
            $table->string('proceso')->comment('Numero de proceso')->nullable();
            $table->string('sentencia')->comment('Sentencia')->nullable();
            $table->integer('idcentro')->nullable()->comment('id del centro Centro o comunidad privativa de la libertad de egreso');
            $table->date('egreso')->nullable()->comment('Fecha de egreso del sistema de justicia penal');
            $table->boolean('sustanciasalcohol')->nullable()->comment('Sustancias alcohol');
            $table->boolean('relacionales')->nullable()->comment('relacionales');
            $table->boolean('enfermedades')->nullable()->comment('enfermedades');
            $table->boolean('laboral')->nullable()->comment('laboral');
            $table->boolean('psiquiatricos')->nullable()->comment('Sustancias alcohol');
            $table->boolean('violencia')->nullable()->comment('relacionales');
            $table->boolean('educativo')->nullable()->comment('enfermedades');
            $table->boolean('derivacion')->nullable()->comment('laboral');
            $table->boolean('conductuales')->nullable()->comment('Sustancias alcohol');
            $table->boolean('pobreza')->nullable()->comment('relacionales');
            $table->boolean('capacitacion')->nullable()->comment('enfermedades');
            $table->string('otras')->nullable()->comment('otras');
            $table->boolean('ap_mujeres')->nullable()->comment('Sustancias alcohol');
            $table->boolean('ap_personaindigena')->nullable()->comment('relacionales');
            $table->boolean('ap_personavih')->nullable()->comment('enfermedades');
            $table->boolean('ap_lgbttti')->nullable()->comment('laboral');
            $table->boolean('ap_situacioncalle')->nullable()->comment('Sustancias alcohol');
            $table->boolean('ap_personamayor')->nullable()->comment('relacionales');
            $table->boolean('ap_personadisca')->nullable()->comment('enfermedades');
            $table->boolean('ap_ninguno')->nullable()->comment('laboral');
            $table->boolean('ap_migrante')->nullable()->comment('Sustancias alcohol');
            $table->boolean('tieneacta')->nullable()->comment('tiene acta de nacimientos'); 
            $table->string('anotaacta')->nullable()->comment('anotaciones sobre el acta de nacimientos'); 
            $table->boolean('tieneid')->nullable()->comment('Cuenta con alguna identificación oficial'); 
            $table->string('anotaid')->nullable()->comment('anotaciones sobre la identificacion oficial'); 
            $table->boolean('tienecurp')->nullable()->comment('tiene curp'); 
            $table->string('anotacurp')->nullable()->comment('anotaciones sobre la curp'); 
            $table->integer('estatus')->nullable()->comment('estatus del expediente 0=capturando 1=capturado')->default(0); 
            $table->boolean('tr_esformal')->nullable()->comment('tipo de empleo antes de su privación'); 
            $table->string('tr_puesto')->nullable()->comment('puesto'); 
            $table->integer('tr_sueldo')->nullable()->comment('sueldo')->default(0); 
            $table->string('tr_duracion')->nullable()->comment('duracion del ultimo trabajo'); 
            $table->text('tr_motivo')->nullable()->comment('Motivo de salida'); 
            $table->boolean('tr_tieneunoficio')->nullable()->comment('Cuenta con algun oficio'); 
            $table->text('tr_donde')->nullable()->comment('cual y donde lo aprendio'); 
            $table->boolean('tr_laboro')->nullable()->comment('¿Laboró durante su sentencia?'); 
            $table->string('tr_laboroenque')->nullable()->comment('laboro en que'); 
            $table->boolean('tr_secapacito')->nullable()->comment('¿Recibió alguna capacitación laboral durante el cumplimiento de la sentencia?'); 
            $table->string('tr_secapacitoenque')->nullable()->comment('Capacito en que'); 
            $table->boolean('tr_ennomina')->nullable()->comment('¿Estaba en nómina?'); 
            $table->boolean('tr_fondoahorro')->nullable()->comment('¿Generó fondo de ahorro?'); 
            $table->boolean('tr_conempleo')->nullable()->comment('d) ¿Actualmente cuenta con un empleo?'); 
            $table->boolean('tr_empleoformal')->nullable()->comment('El empleo es formal?'); 
            $table->string('tr_queempleo')->nullable()->comment('Que empleo'); 
            $table->integer('tr_ingreso')->nullable()->comment('ingreso mensual')->default(0); 
            $table->string('tr_tempodesempleo')->nullable()->comment('Tiempo de estar desempleado')->default(0); 
            $table->integer('tr_intentos')->nullable()->comment('Número de intentos en la búsqueda de trabajo:')->default(0); 
            $table->text('tr_funciones')->nullable()->comment('Describa las funciones y/o actividades que realiza:'); 
            $table->text('tr_expectativas')->nullable()->comment('Señalar expectativas laborales a corto y largo plazo:'); 
            $table->text('tr_observaciones')->nullable()->comment('Observaciones del/la entrevistador/a:'); 
            $table->integer('ed_idescolaridad')->nullable()->comment('id de la escolaridad de acuerdo al catalogo de escolaridades');
            $table->boolean('ed_escolaridadtrunca')->nullable()->comment('la escolaridad es trunca'); 
            $table->text('ed_motivodeser')->nullable()->comment('Motivo de deserción'); 
            $table->text('ed_actividadesedu')->nullable()->comment('2. ¿Realizó actividades educativas en el centro penitenciario? ¿Cuáles?'); 
            $table->boolean('ed_deseacontinuar')->nullable()->comment('3. ¿Desea continuar con sus estudios?'); 
            $table->text('ed_quelegustaria')->nullable()->comment('En caso de querer continuar ¿Qué le gustaría estudiar?'); 
            $table->text('ed_observaciones')->nullable()->comment('4. Observaciones del/la entrevistador/a:'); 
            $table->boolean('sa_ser_ninguno')->nullable()->comment('Servicio ninguno'); 
            $table->boolean('sa_ser_imss')->nullable()->comment('Servicio IMSS'); 
            $table->boolean('sa_ser_isste')->nullable()->comment('Servicio ISSTTE'); 
            $table->boolean('sa_ser_privado')->nullable()->comment('Servicio privado'); 
            $table->boolean('sa_ser_popular')->nullable()->comment('Servicio seguro popular'); 
            $table->string('sa_ser_otro')->nullable()->comment('Servicio otro'); 
            $table->integer('sa_estadosalud')->nullable()->comment('Estado de salud 1=bueno 2=Regular 3=Malo')->default(0); 
            $table->string('sa_porque')->nullable()->comment('razon del estado de salud'); 
            $table->integer('sa_tieneproblema')->nullable()->comment('Tiene algun problema de salud 1=si 2=no 3=desconoce')->default(0); 
            $table->string('sa_cual')->nullable()->comment('En caso de contestar afirmativamente, ¿cuál?'); 
            $table->boolean('sa_tratamiento')->nullable()->comment('c) ¿Cuenta con tratamiento médico?'); 
            $table->string('sa_tratamientocual')->nullable()->comment('En caso de contestar afirmativamente, ¿cuál?'); 
            $table->boolean('sa_quierevaloracion')->nullable()->comment('d) ¿Desea asistir a valoración médica?'); 
            $table->text('sa_quierevaloracionporque')->nullable()->comment('En caso de contestar negativamente, ¿por qué?'); 
            $table->boolean('sa_discapacidad')->nullable()->comment('d) ¿Desea asistir a valoración médica?'); 
            $table->boolean('sa_visual')->nullable()->comment('discapacidad visual'); 
            $table->boolean('sa_intelectual')->nullable()->comment('discapacidad intelectual'); 
            $table->boolean('sa_lenguaje')->nullable()->comment('discapacidad lenguaje'); 
            $table->boolean('sa_auditiva')->nullable()->comment('discapacidad auditiva'); 
            $table->boolean('sa_cuidadopersonal')->nullable()->comment('discapacidad cuidado personal'); 
            $table->boolean('sa_emocional')->nullable()->comment('discapacidad emocional'); 
            $table->boolean('sa_motora')->nullable()->comment('discapacidad motora'); 
            $table->integer('sa_dificultad')->nullable()->comment('dificultad 1=poca 2=mucha 3=No puede hacerlo 4=Sin dificultad')->default(0); 
            $table->integer('sa_causa')->nullable()->comment('dificultad 1=enfermedad 2=sin dificultad 3=Accidente 4=Congenita 5=edad 6=otra 7=Violencia')->default(0);
            $table->text('sa_diagnostico')->nullable()->comment('diagnostico'); 
            $table->boolean('sa_indicatratamiento')->nullable()->comment('¿Se indica tratamiento?'); 
            $table->boolean('sa_secanaliza')->nullable()->comment('¿Se realiza canalización a servicio médico?'); 
            $table->text('sa_secanalizacuales')->nullable()->comment('si se canaliza cual es?'); 
            $table->text('sa_observacionessalud')->nullable()->comment('observaciones'); 
            $table->boolean('sa_tomodrogas')->nullable()->comment('¿En los últimos 12 meses, tomó alguna de estas sustancias, en más de una ocasión, para sentirse mejor o para cambiar su estado de ánimo?'); 
            $table->integer('sa_idtiposustancia')->nullable()->comment('id del tipo de sustancias de acuerdo al cataloog de tipo de sustancias')->default(0); 
            $table->integer('sa_edadinicio')->nullable()->comment('Edad de inicio')->default(0); 
            $table->integer('sa_idfrecuencia')->nullable()->comment('con que frecuencia se drogaba')->default(0); 
            $table->string('sa_cuando')->nullable()->comment('Cuándo fue el primer contacto con la sustancia:'); 
            $table->string('sa_tiempo')->nullable()->comment('Tiempo de uso:'); 
            $table->boolean('sa_intentado')->nullable()->comment('¿Ha tratado de reducir o dejar su consumo?'); 
            $table->integer('sa_idtipodeatencion')->nullable()->comment('id tipo de atencion de acuerdo al catalogo de tipo de atenciones')->default(0); 
            $table->integer('sa_duracion')->nullable()->comment('duracion de la experiencia')->default(0); 
            $table->boolean('sa_recaido')->nullable()->comment('Reincidencia en el consumo'); 
            $table->text('sa_observacionesdrogas')->nullable()->comment('observaciones consumo de drogas'); 
            $table->numeric('fa_id_file001')->nullable()->comment('archivo familograma'); 
            $table->text('fa_observaciones')->nullable()->comment('observaciones del entrevistador'); 
            $table->text('fa_idparentesco')->nullable()->comment('id del parentesco de acuerdo al catalogo de parentescos'); 
            $table->integer('fa_ano')->nullable()->comment('año cuando fue el acontecimiento'); 
            $table->string('fa_delito')->nullable()->comment('delito'); 
            $table->string('fa_tiempo')->nullable()->comment('Tiempo de privación de la libertad:'); 
            $table->string('fa_centro')->nullable()->comment('Centro penitenciario:'); 
            $table->text('fa_observaciones1')->nullable()->comment('observaciones del entrevistador'); 
            $table->integer('ts_idtipodegrupo')->nullable()->comment('id tipo de atencion de acuerdo al catalogo de tipo de atenciones')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expedientes');
    }
}
