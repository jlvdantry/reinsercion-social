<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBeneficiarioExpedientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->integer('idbeneficiario')->comment('id del beneficiario de acuerdo a la tabla de beneficiarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expedientes', function (Blueprint $table) {
               $table->dropColumn('idbeneficiario');
        });
    }
}
