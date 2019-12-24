<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunciondefecha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement('
CREATE OR REPLACE FUNCTION xcambio_fecha(TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,integer) 
RETURNS VARCHAR AS $body$ 
DECLARE 
    var_fecha01 alias FOR $1; 
    var_fecha02 alias FOR $2; 
    var_fecha03 alias FOR $3; 
    var_fecha04 alias FOR $4; 
    var_fecha05 alias FOR $5; 
    var_fecha06 alias FOR $6; 
    var_fecha07 alias FOR $7; 
    var_fecha08 alias FOR $8; 
    var_fecha09 alias FOR $9; 
    var_fecha10 alias FOR $10; 
    sesiones alias for $11;
    res_fecha record; 
BEGIN 
    SELECT INTO res_fecha 
    (CASE 
    WHEN EXTRACT(MONTH FROM var_fecha01)=1 THEN (EXTRACT(DAY FROM var_fecha01)||\' Ene\')
    WHEN EXTRACT(MONTH FROM var_fecha01)=4 THEN (EXTRACT(DAY FROM var_fecha01)||\' Abr\')
    WHEN EXTRACT(MONTH FROM var_fecha01)=8 THEN (EXTRACT(DAY FROM var_fecha01)||\' Ago\')
    WHEN EXTRACT(MONTH FROM var_fecha01)=12 THEN (EXTRACT(DAY FROM var_fecha01)||\' Dic\')
    ELSE to_char(var_fecha01,\'dd Mon\')  
    END) AS fecha
    , case when sesiones=2 then
    CASE
    WHEN EXTRACT(MONTH FROM var_fecha02)=1 THEN (EXTRACT(DAY FROM var_fecha02)||\' Ene\')
    WHEN EXTRACT(MONTH FROM var_fecha02)=4 THEN (EXTRACT(DAY FROM var_fecha02)||\' Abr\')
    WHEN EXTRACT(MONTH FROM var_fecha02)=8 THEN (EXTRACT(DAY FROM var_fecha02)||\' Ago\')
    WHEN EXTRACT(MONTH FROM var_fecha02)=12 THEN (EXTRACT(DAY FROM var_fecha02)||\' Dic\')
    ELSE to_char(var_fecha01,\'dd Mon\')
    END 
          when sesiones=3 then
    CASE
    WHEN EXTRACT(MONTH FROM var_fecha03)=1 THEN (EXTRACT(DAY FROM var_fecha03)||\' Ene\')
    WHEN EXTRACT(MONTH FROM var_fecha03)=4 THEN (EXTRACT(DAY FROM var_fecha03)||\' Abr\')
    WHEN EXTRACT(MONTH FROM var_fecha03)=8 THEN (EXTRACT(DAY FROM var_fecha03)||\' Ago\')
    WHEN EXTRACT(MONTH FROM var_fecha03)=12 THEN (EXTRACT(DAY FROM var_fecha03)||\' Dic\')
    ELSE to_char(var_fecha03,\'dd Mon\')
    END

      end as fechafin
; 
     
    RETURN res_fecha.fecha::VARCHAR || \' - \' || res_fecha.fechafin::VARCHAR; 
END; 
$body$ LANGUAGE \'plpgsql\';
');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         //DB::statement('drop function xcambio_fecha(TIMESTAMP)');
         DB::statement('drop function xcambio_fecha(TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,TIMESTAMP,integer)');
    }
}
