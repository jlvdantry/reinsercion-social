<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDemandaIdresultado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demandas', function (Blueprint $table) {
         DB::statement('ALTER TABLE demandas alter idresultado  type numeric(10) USING idresultado::numeric(10,0); ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demandas', function (Blueprint $table) {
            //
        });
    }
}
