<?php

use Illuminate\Database\Seeder;

class Frecuencias_rs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $sql = base_path('database/seeds/Inserta_frecuencias_rs.sql');
         DB::unprepared(file_get_contents($sql));
    }
}
