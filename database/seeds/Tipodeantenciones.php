<?php

use Illuminate\Database\Seeder;

class Tipodeatenciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $sql = base_path('database/seeds/Inserta_tipodeatenciones.sql');
         DB::unprepared(file_get_contents($sql));
    }
}
