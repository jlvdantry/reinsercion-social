<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('api_token', 80)->after('password')
                        ->unique()
                        ->nullable()
                        ->default(null);
            $table->smallInteger('activo')->nullable()->default(0)->comment('0=inactivo,1=activo,3=bloqueado');
            $table->string('nombres');
            $table->string('ape_pat')->nullable();
            $table->string('ape_mat')->nullable();
            $table->string('puesto')->nullable();
            $table->double('num_telefono',10,0)->nullable()->comment('10 digitos');
            $table->string('idperfiltallerista')->nullable()->comment('perfil del tallerista');
            $table->string('tipousuario')->nullable()->comment('0=usuario interno del sistema,1=beneficiario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
